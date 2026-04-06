{{-- filepath: c:\xampp\htdocs\apotek-lsp\resources\views\be\pengiriman\index.blade.php --}}
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
                        <div class="card shadow-sm mt-4 mx-2">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Data Pengiriman</h4>
                                <a href="{{ route('pengiriman.create') }}" class="btn btn-primary">
                                    Tambah Pengiriman
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
                                                <th class="align-middle fw-bold" width="12%">No Invoice</th>
                                                <th class="align-middle fw-bold" width="12%">No Resi</th>
                                                <th class="align-middle fw-bold" width="15%">Penjualan</th>
                                                <th class="align-middle fw-bold" width="13%">Tgl Kirim</th>
                                                <th class="align-middle fw-bold" width="13%">Tgl Tiba</th>
                                                <th class="align-middle fw-bold" width="10%">Status</th>
                                                <th class="align-middle fw-bold" width="15%">Kurir</th>
                                                <th class="align-middle fw-bold" width="10%">Bukti</th>
                                                <th class="text-center align-middle fw-bold" width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pengirimans as $i => $item)
                                            <tr>
                                                <td class="text-center">{{ $i+1 }}</td>
                                                <td>{{ $item->no_invoice }}</td>
                                                <td>{{ $item->no_resi }}</td>
                                                <td>{{ $item->penjualan->no_pemesanan ?? '-' }}
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $item->penjualan && $item->penjualan->pelanggan ? $item->penjualan->pelanggan->nama_pelanggan : '-' }}
                                                    </small>
                                                        @if($item->penjualan && $item->penjualan->pelanggan)
                                                            {{ $item->penjualan->pelanggan->alamat1 ?? '' }}
                                                            {{ $item->penjualan->pelanggan->kota1 ? ', ' . $item->penjualan->pelanggan->kota1 : '' }}
                                                            {{ $item->penjualan->pelanggan->propinsi1 ? ', ' . $item->penjualan->pelanggan->propinsi1 : '' }}
                                                            {{ $item->penjualan->pelanggan->kodepos1 ? ' - ' . $item->penjualan->pelanggan->kodepos1 : '' }}
                                                        @else
                                                            -
                                                        @endif
                                                </td>
                                                <td>{{ $item->tgl_kirim }}</td>
                                                <td>{{ $item->tgl_tiba }}</td>
                                                <td>
                                                    <span class="badge {{ $item->status_kirim == 'Sedang Dikirim' ? 'bg-warning' : 'bg-success' }}">
                                                        {{ $item->status_kirim }}
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $item->nama_kurir }}<br>
                                                    <small>{{ $item->telpon_kurir }}</small>
                                                </td>
                                                <td>
                                                    @if($item->bukti_foto)
                                                        <img src="{{ asset('storage/'.$item->bukti_foto) }}" alt="Bukti" width="60">
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('pengiriman.setMenungguKurir', $item->id) }}" method="POST" class="d-inline form-kurir">
                                                        @csrf
                                                        <button type="button" class="btn btn-sm btn-primary btn-kurir">
                                                            <i class="fa-solid fa-headset"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('pengiriman.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                                        @csrf @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger btn-delete"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if ($pengirimans->hasPages())
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                        <nav>
                                            <ul class="pagination pagination-sm mb-0">
                                                @if ($pengirimans->onFirstPage())
                                                    <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $pengirimans->previousPageUrl() }}">&laquo;</a></li>
                                                @endif
                                                @foreach ($pengirimans->getUrlRange(1, $pengirimans->lastPage()) as $page => $url)
                                                    @if ($page == $pengirimans->currentPage())
                                                        <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                    @endif
                                                @endforeach
                                                @if ($pengirimans->hasMorePages())
                                                    <li class="page-item"><a class="page-link" href="{{ $pengirimans->nextPageUrl() }}">&raquo;</a></li>
                                                @else
                                                    <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                @endif
                                            </ul>
                                        </nav>
                                        <div class="text-muted small ms-1 mb-2 mb-md-0">
                                            Menampilkan {{ $pengirimans->firstItem() }} - {{ $pengirimans->lastItem() }} dari {{ $pengirimans->total() }} data
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
        // Delete confirmation
        document.querySelectorAll('.btn-delete').forEach(function(btn) {
            btn.addEventListener('click', function () {
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Set Menunggu Kurir confirmation
        document.querySelectorAll('.btn-kurir').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Ubah Status Pengiriman?',
                    text: "Status akan diubah menjadi Menunggu Kurir",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Ubah!',
                    cancelButtonText: 'Batal'
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