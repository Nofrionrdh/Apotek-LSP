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
                                <h4 class="mb-0">Daftar Jenis Pengiriman</h4>
                                <a href="{{ route('jenis-pengiriman.create') }}" class="btn btn-primary">
                                    Tambah Jenis Pengiriman
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
                                                <th class="align-middle fw-bold" width="15%">Jenis Kirim</th>
                                                <th class="align-middle fw-bold" width="20%">Nama Ekspedisi</th>
                                                <th class="align-middle fw-bold" width="15%">Ongkos Kirim</th>
                                                <th class="align-middle fw-bold" width="15%">Logo Ekspedisi</th>
                                                <th class="text-center align-middle fw-bold" width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="font-medium">
                                            @forelse ($jenis_pengirimans as $item)
                                                <tr class="align-middle">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->jenis_kirim }}</td>
                                                    <td>{{ $item->nama_ekspedisi }}</td>
                                                    <td>Rp {{ number_format($item->ongkos_kirim, 0, ',', '.') }}</td>
                                                    <td class="text-center">
                                                        @if($item->logo_ekspedisi)
                                                            <img src="{{ asset('storage/' . $item->logo_ekspedisi) }}" alt="Logo" width="60" height="60" style="object-fit:contain;">
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('jenis-pengiriman.edit', $item->id) }}"
                                                                class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                            <form action="{{ route('jenis-pengiriman.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
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
                                                    <td colspan="6" class="text-center text-muted">Data jenis pengiriman tidak ditemukan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if ($jenis_pengirimans->hasPages())
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                        <nav>
                                            <ul class="pagination pagination-sm mb-0">
                                                @if ($jenis_pengirimans->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $jenis_pengirimans->previousPageUrl() }}">&laquo;</a></li>
                                                @endif
                                                @foreach ($jenis_pengirimans->getUrlRange(1, $jenis_pengirimans->lastPage()) as $page => $url)
                                                    @if ($page == $jenis_pengirimans->currentPage())
                                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                                @if ($jenis_pengirimans->hasMorePages())
                                                    <li class="page-item"><a class="page-link" href="{{ $jenis_pengirimans->nextPageUrl() }}">&raquo;</a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                @endif
                                            </ul>
                                        </nav>
                                        <div class="text-muted small ms-1 mb-2 mb-md-0">
                                            Menampilkan {{ $jenis_pengirimans->firstItem() }} - {{ $jenis_pengirimans->lastItem() }} dari {{ $jenis_pengirimans->total() }} data
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
