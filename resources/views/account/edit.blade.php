@extends('templates.nav', ['title' => 'Edit Data Akun'])

@section('content-dinamis')
@if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif
    <form action="{{ route('user.edit.update', $akun['id']) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group mb-3">
            <label for="name" class="form-label">Nama Akun</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $akun['name'] }}">
        </div>
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $akun['email'] }}">
        </div>
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group mb-3">
            <label for="role" class="form-label">Role Akun</label>
            <select name="role" id="role" class="form-select">
                <option value="admin" {{ $akun['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="pelanggan" {{ $akun['role'] == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
            </select>
        </div>
        @error('role')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <button type="submit" class="btn btn-primary">Ubah Data</button>
    </form>
@endsection