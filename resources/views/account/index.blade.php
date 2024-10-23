@extends('templates.nav', ['title' => 'Kelola Akun'])

@section('content-dinamis')
<a href="{{ route('user.add.tambah') }}" class="btn btn-success mb-3">Tambah Pengguna</a>

@if(Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

<div class="table-responsive">
    <table class="table table-bordered table-striped text-center">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($akun) > 0)
                    @foreach ($akun as $index => $item)
                        <tr>
                            <td>{{ ($akun->currentPage() - 1) * $akun->perPage() + ($index + 1) }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['email'] }}</td>
                            {{-- <td>{{ $item['password'] }}</td> --}}
                            <td>{{ $item['role']}}</td>
                            
                            <td class="d-flex justify-content-center py-1">
                                <a href="{{route('user.edit', $item['id'])}}" class="btn btn-primary btn-sm me-2">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="showModal('{{ $item->id}}', '{{ $item->name}}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
        </tbody>
    </table>
    </div>
    <div class="d-flex justify-content-end mt-3">
        {{ $akun->links() }}
    </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="form-delete-akun" method="POST">
                    @csrf

                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin ingin menghapus akun <span id="nama-user"></span>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                            <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection


@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            let action='{{ route("user.delete", ":id") }}';
            action = action.replace(':id', id);
            $('#form-delete-akun').attr('action', action);
            $('#exampleModal').modal('show');
            console.log(name);
            $('#nama-user').text(name);
        }
    </script>
@endpush