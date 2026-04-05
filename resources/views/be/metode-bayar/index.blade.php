{{-- filepath: c:\xampp\htdocs\apotek-lsp\resources\views\be\metode-bayar\index.blade.php --}}
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
                                <h4 class="mb-0">Daftar Metode Pembayaran</h4>
                                <a href="{{ route('metode-bayar.create') }}" class="btn btn-primary">
                                    Tambah Metode
                                </a>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-borderless table-striped font-roboto">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="text-center align-middle fw-bold" width="5%">No</th>
                                                <th class="align-middle fw-bold" width="20%">Metode</th>
                                                <th class="align-middle fw-bold" width="20%">Tempat Bayar</th>
                                                <th class="align-middle fw-bold" width="20%">No. Rekening</th>
                                                <th class="align-middle fw-bold" width="15%">Logo</th>
                                                <th class="text-center align-middle fw-bold" width="20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="font-medium">
                                            @forelse($metodes as $item)
                                                <tr class="align-middle">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->metode_pembayaran }}</td>
                                                    <td>{{ $item->tempat_bayar }}</td>
                                                    <td>{{ $item->no_rekening }}</td>
                                                    <td>
                                                        @if($item->url_logo)
                                                            <img src="{{ asset('storage/'.$item->url_logo) }}" alt="Logo" style="height:36px;max-width:80px;">
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('metode-bayar.edit', $item->id) }}"
                                                                class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                            <form action="{{ route('metode-bayar.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
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
                                                    <td colspan="6" class="text-center text-muted">Belum ada data metode pembayaran.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($metodes->hasPages())
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                        <nav>
                                            <ul class="pagination pagination-sm mb-0">
                                                @if ($metodes->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $metodes->previousPageUrl() }}">&laquo;</a></li>
                                                @endif
                                                @foreach ($metodes->getUrlRange(1, $metodes->lastPage()) as $page => $url)
                                                    @if ($page == $metodes->currentPage())
                                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                                @if ($metodes->hasMorePages())
                                                    <li class="page-item"><a class="page-link" href="{{ $metodes->nextPageUrl() }}">&raquo;</a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                @endif
                                            </ul>
                                        </nav>
                                        <div class="text-muted small ms-1 mb-2 mb-md-0">
                                            Menampilkan {{ $metodes->firstItem() }} - {{ $metodes->lastItem() }} dari {{ $metodes->total() }} data
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
        // SweetAlert hapus
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