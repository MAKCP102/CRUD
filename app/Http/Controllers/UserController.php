<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $akun = User::orderBy('name', 'ASC')->simplePaginate(10);
        return view('account.index', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account.useradd');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function tambah(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role' => 'required',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Email tidak valid!',
            'role.required' => 'Role wajib diisi!',
        ]);

        $proses = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        if ($proses) {
            return redirect()->route('user')->with('success', 'Akun berhasil ditambahkan!');
        } else {
            return redirect()->route('user.add')->with('failed', 'Gagal menambahkan akun!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $akun = User::where('id', $id)->first();
        return view('account.edit', compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
        ], [
            'role.required' => 'Role pengguna wajib diisi!',
            'name.required' => 'Nama barang wajib diisi!',
            'email.required' => 'Email pengguna wajib diisi!',
            'email.email' => 'Email tidak valid!',
        ]);
        $akunBefore = User::where('id', $id)->first();

        $proses = $akunBefore->update([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if ($proses) {
            return redirect()->route('user')->with('success', 'Data akun berhasil diubah!');
        } else {
            return redirect()->route('user.edit', $id)->with('failed', 'Gagal mengubah data akun!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = User::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'Data akun berhasil dihapus!');
        } else {
            return redirect()->back()->with('failed', 'Gagal menghapus data akun!');
        }
    }
}
