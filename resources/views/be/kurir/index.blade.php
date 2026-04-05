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
                            <div class="card-header bg-info text-white">
                                <h4 class="mb-0">Daftar Pengiriman Saya</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-info">
                        <tr>
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>No Resi</th>
                            <th>Penjualan</th>
                            <th>Tgl Kirim</th>
                            <th>Tgl Tiba</th>
                            <th>Status Kirim</th>
                            <th>Telpon Kurir</th>
                            <th>Bukti Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengirimans as $i => $item)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $item->no_invoice }}</td>
                            <td>{{ $item->no_resi }}</td>
                            <td>{{ $item->penjualan->no_pemesanan ?? '-' }}</td>
                            <td>{{ $item->tgl_kirim }}</td>
                            <td>{{ $item->tgl_tiba }}</td>
                            <td>
                                <span class="badge {{ $item->status_kirim == 'Sedang Dikirim' ? 'bg-warning text-dark' : 'bg-success' }}">
                                    {{ $item->status_kirim }}
                                </span>
                            </td>
                            <td>{{ $item->telpon_kurir }}</td>
                            <td>
                                @if($item->bukti_foto)
                                    <img src="{{ asset('storage/'.$item->bukti_foto) }}" alt="Bukti" width="60" class="rounded shadow-sm border">
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('kurir.setDikirim', $item->id) }}" method="POST" class="d-inline form-kirim">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-info mb-1 btn-kirim" title="Set Dikirim">
                                        <i class="fa fa-truck"></i>
                                    </button>
                                </form>
                                <form action="{{ route('kurir.setSelesai', $item->id) }}" method="POST" class="d-inline form-selesai">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-success mb-1 btn-selesai" title="Set Selesai">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-muted">Tidak ada data pengiriman untuk Anda.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                                </div>
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
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle Kirim button
        document.querySelectorAll('.btn-kirim').forEach(function(button) {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Update Status Pengiriman?',
                    text: "Status pesanan akan diubah menjadi Sedang Dikirim",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0dcaf0',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Handle Selesai button
        document.querySelectorAll('.btn-selesai').forEach(function(button) {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Selesaikan Pengiriman?',
                    text: "Status pesanan akan diubah menjadi Selesai",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#198754',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Selesaikan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 1500,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endpush