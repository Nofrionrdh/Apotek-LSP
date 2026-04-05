@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('main-content')
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="row w-100">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">Daftar Distributor</h4>
                                    <a href="{{ route('distributor.create') }}" class="btn btn-primary">
                                        Tambah Distributor
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th width="5%">No</th>
                                                    <th width="25%">Nama Distributor</th>
                                                    <th width="20%">Telepon</th>
                                                    <th width="35%">Alamat</th>
                                                    <th width="15%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($distributors as $item)  {{-- Ubah variable dan gunakan forelse --}}
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->nama_distributor }}</td>
                                                        <td>{{ $item->telepon }}</td>
                                                        <td>{{ $item->alamat }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('distributor.edit', $item->id) }}"
                                                                    class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                                <form action="{{ route('distributor.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Tidak ada data distributor</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($distributors->hasPages())
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                            <nav>
                                                <ul class="pagination pagination-sm mb-0">
                                                    @if ($distributors->onFirstPage())
                                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $distributors->previousPageUrl() }}">&laquo;</a></li>
                                                    @endif
                                                    @foreach ($distributors->getUrlRange(1, $distributors->lastPage()) as $page => $url)
                                                        @if ($page == $distributors->currentPage())
                                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                        @endif
                                                    @endforeach
                                                    @if ($distributors->hasMorePages())
                                                        <li class="page-item"><a class="page-link" href="{{ $distributors->nextPageUrl() }}">&raquo;</a></li>
                                                    @else
                                                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                    @endif
                                                </ul>
                                            </nav>
                                            <div class="text-muted small ms-1 mb-2 mb-md-0">
                                                Menampilkan {{ $distributors->firstItem() }} - {{ $distributors->lastItem() }} dari {{ $distributors->total() }} data
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const form = btn.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection
