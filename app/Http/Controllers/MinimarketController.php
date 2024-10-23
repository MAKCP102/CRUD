<?php

namespace App\Http\Controllers;

use App\Models\Minimarket;
use Illuminate\Http\Request;

class MinimarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $minimarkets = Minimarket::where('name', 'LIKE', '%' . '%')->orderBy('name', 'ASC')->simplePaginate(10);
        return view('minimarkets.barang', compact('minimarkets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('minimarkets.stock');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required|',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ], [
            'type.required' => 'Jenis barang wajib diisi!',
            'name.required' => 'Nama barang wajib diisi!',
            'price.required' => 'Harga barang wajib diisi!',
            'price.numeric' => 'Harga barang harus berupa angka!',
            'stock.required' => 'Stok barang wajib diisi!',
            'stock.numeric' => 'Stok barang harus berupa angka!',
        ]);

        $proses = Minimarket::create([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($proses) {
            return redirect()->route('minimarket')->with('berhasil', 'Data barang berhasil ditambahkan!');
        } else {
            return redirect()->route('minimarket.add')->with('failed', 'Gagal menambahkan data barang!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Minimarket $minimarket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $minimarkets = Minimarket::where('id', $id)->first();
        return view('minimarkets.edit', compact('minimarkets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
        ], [
            'type.required' => 'Jenis barang wajib diisi!',
            'name.required' => 'Nama barang wajib diisi!',
            'price.required' => 'Harga barang wajib diisi!',
            'price.numeric' => 'Harga barang harus berupa angka!',
            'stock.required' => 'Stock barang wajib diisi!',
            'stock.numeric' => 'Stock barang harus berupa angka!',
        ]);
        $minimarketBefore = Minimarket::where('id', $id)->first();

        $proses = $minimarketBefore->update([
            'type' => $request->type,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        if ($proses) {
            return redirect()->route('minimarket')->with('success', 'Data barang berhasil diubah!');
        } else {
            return redirect()->route('minimarket.edit', $id)->with('failed', 'Gagal mengubah data barang!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = Minimarket::where('id', $id)->delete();
        if ($proses) {
            // redirect()->back() : kembali ke halaman sebelum destroy dijalanin (halaman button delete berada)
            return redirect()->back()->with('success', 'Data barang berhasil dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data barang!');
        }
    }
}
