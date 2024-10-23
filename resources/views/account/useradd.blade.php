@extends('templates.nav', ['title' => 'Tambah Pengguna'])

@section('content-dinamis')
<form class="p-4 mt-2" style="border: 1px solid black" action="{{ route('user.add.tambah') }}" method="POST">
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
    <label for="name" class="form-label">Nama </label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
</div>
<div class="form-group">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
</div>
<div class="form-group">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
</div>
<div class="form-group">
    <label for="role" class="form-label">Role</label>
    <select name="role" id="role" class="form-select">
        <option hidden selected disabled>Pilih Role</option>
        <option value="admin" {{ old('admin') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="pelanggan" {{ old('pelanggan') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
    </select>
</div>
<button type="submit" class="btn btn-success mt-3">Kirim Data</button>
</form>
@endsection