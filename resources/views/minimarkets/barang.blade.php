@extends('templates.nav', ['title' => 'Data Barang'])

@section('content-dinamis')
<a href="{{ route('minimarket.add') }}" class="btn btn-success mb-3">+ Tambah Barang</a>

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
                <th>Nama Obat</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($minimarkets) > 0)
            @foreach ($minimarkets as $index => $item)
                <tr>
                    <td>{{ ($minimarkets->currentPage() - 1) * $minimarkets->perPage() + ($index + 1) }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['type'] }}</td>
                    <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : 'bg-white text-dark' }}">
                        {{ $item['stock'] }}</span>
                    </td>
                    <td class="d-flex justify-content-center py-1">
                    </td>
                    <td class="d-flex justify-content-center py-1">
                        <a href="{{route('minimarket.edit', $item['id'])}}" class="btn btn-primary btn-sm me-2">Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="showModal('{{ $item->id}}', '{{ $item->name}}')">Hapus</button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center fw-bold">Data masih kosong</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-end mt-3">
    {{ $minimarkets->links() }}
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="form-delete-barang" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus barang <span id="nama-barang"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
    <script>
        //fungsi untuk menampilkan modal
        function showModal(id, name) {
            //isi untuk action form
            let action='{{ route("minimarket.delete", ":id") }}';
            action = action.replace(':id', id);
            //buat attribute action pada form
            $('#form-delete-barang').attr('action', action);
            //munculkan modal yang id nya exampleModal
            $('#exampleModal').modal('show');
            //innerText pada element html id nama-obat
            console.log(name);
            $('#nama-barang').text(name);
        }
    </script>
@endpush
@endsection