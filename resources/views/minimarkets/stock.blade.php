@extends('templates.nav', ['title' => 'Edit Stock'])

@section('content-dinamis')
<div class="m-auto" style="width: 65%">
    <form class="p-4 mt-2" style="border: 1px solid black" action="{{ route('minimarket.add.store') }}" method="POST">
    @if (Session::get('failed'))
        <div class="alert alert-danger">{{Session::get('failed')}}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ol>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nama Barang</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="type" class="form-label">Tipe Barang</label>
            <select name="type" id="type" class="form-select">
                <option hidden selected disabled>Pilih Tipe</option>
                <option value="sayuran" {{ old('type') == 'sayuran' ? 'selected' : '' }}>Sayuran</option>
                <option value="buah" {{ old('type') == 'buah' ? 'selected' : '' }}>Buah</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Harga barang</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
        </div>
        <button type="submit" class="btn btn-success mt-3">Kirim Data</button>
    </form>
</div>
@endsection