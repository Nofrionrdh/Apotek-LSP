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
                                    <h4 class="mb-0">Daftar Jenis Obat</h4>
                                    <a href="{{ route('jenis-obat.create') }}" class="btn btn-primary">Tambah Jenis Obat</a>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Gambar</th>
                                                    <th>Nama Jenis</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jenis_obat as $index => $jenis)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td><img src="{{ asset($jenis->image_url) }}" alt="Gambar"
                                                                width="50"></td>
                                                        <td>{{ $jenis->jenis }}</td>
                                                        <td>{{ $jenis->deskripsi_jenis }}</td>
                                                        <td>
                                                            <a href="{{ route('jenis-obat.edit', $jenis->id) }}"
                                                                class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>
                                                            <form action="{{ route('jenis-obat.destroy', $jenis->id) }}" method="POST" class="d-inline form-delete">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($jenis_obat->hasPages())
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                            <nav>
                                                <ul class="pagination pagination-sm mb-0">
                                                    @if ($jenis_obat->onFirstPage())
                                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $jenis_obat->previousPageUrl() }}">&laquo;</a></li>
                                                    @endif
                                                    @foreach ($jenis_obat->getUrlRange(1, $jenis_obat->lastPage()) as $page => $url)
                                                        @if ($page == $jenis_obat->currentPage())
                                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                        @endif
                                                    @endforeach
                                                    @if ($jenis_obat->hasMorePages())
                                                        <li class="page-item"><a class="page-link" href="{{ $jenis_obat->nextPageUrl() }}">&raquo;</a></li>
                                                    @else
                                                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                    @endif
                                                </ul>
                                            </nav>
                                            <div class="text-muted small ms-1 mb-2 mb-md-0">
                                                Menampilkan {{ $jenis_obat->firstItem() }} - {{ $jenis_obat->lastItem() }} dari {{ $jenis_obat->total() }} data
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
