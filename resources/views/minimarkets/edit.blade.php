@extends('templates.nav', ['title' => 'Edit Barang'])

@section('content-dinamis')
@if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif
    <form action="{{ route('minimarket.edit.update', $minimarkets['id']) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $minimarkets['name'] }}">
        </div>
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="type" class="form-label">Tipe Barang</label>
            <select name="type" id="type" class="form-select">
                <option value="sayuran" {{ $minimarkets['type'] == 'sayuran' ? 'selected' : '' }}>Sayuran</option>
                <option value="buah" {{ $minimarkets['type'] == 'buah' ? 'selected' : '' }}>Buah</option>
            </select>
        </div>
        @error('type')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="price" class="form-label">Harga</label>
            {{-- $medicine dari compact, yg mengambil first() data yg mau diedit --}}
            <input type="number" class="form-control" id="price" name="price" value="{{ $minimarkets['price'] }}">
        </div>
        @error('price')
        {{-- $message : memunculkan error terkait dengan price --}}
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ $minimarkets['stock'] }}">
        </div>
        @error('stock')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
@endsection