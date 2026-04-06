@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="row w-100">
                    <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Penjualan</h4>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Transaksi</th>
                                            <th>Pelanggan</th>
                                            <th>Total Bayar</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($penjualan as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->no_pemesanan }}</td>
                                                <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                                                <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                                <td>
                                                    @php
                                                        $statusClass = match($item->status_order) {
                                                            'Menunggu Konfirmasi' => 'badge bg-warning text-dark',
                                                            'Diproses' => 'badge bg-info text-white',
                                                            'Menunggu Kurir' => 'badge bg-primary text-white',
                                                            'Selesai' => 'badge bg-success text-white',
                                                            'Dibatalkan Pembeli', 'Dibatalkan Penjual' => 'badge bg-danger text-white',
                                                            default => 'badge bg-secondary'
                                                        };
                                                    @endphp
                                                    <span class="{{ $statusClass }}">{{ $item->status_order }}</span>
                                                    @php
                                                        $paid = in_array($item->status_order, ['Diproses', 'Selesai']);
                                                    @endphp
                                                    <br>
                                                    <span class="badge {{ $paid ? 'bg-success text-white' : 'bg-secondary text-white' }} mt-2">
                                                        {{ $paid ? 'Sudah Dibayarkan' : 'Belum Dibayarkan' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted me-2">{{ $item->keterangan_status ?? '-' }}</small>
                                                        <button type="button" class="btn btn-sm btn-light" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#keteranganModal-{{ $item->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        @if($item->status_order === 'Menunggu Konfirmasi')
                                                            <form action="{{ route('penjualan.approve', $item->id) }}" method="POST" class="d-inline form-approve">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="button" class="btn btn-success btn-sm btn-approve">
                                                                    <i class="fas fa-check"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('penjualan.reject', $item->id) }}" method="POST" class="d-inline form-reject">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="button" class="btn btn-danger btn-sm btn-reject">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data penjualan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if ($penjualan->hasPages())
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            @if ($penjualan->onFirstPage())
                                                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="{{ $penjualan->previousPageUrl() }}">&laquo;</a></li>
                                            @endif
                                            @foreach ($penjualan->getUrlRange(1, $penjualan->lastPage()) as $page => $url)
                                                @if ($page == $penjualan->currentPage())
                                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                @else
                                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                @endif
                                            @endforeach
                                            @if ($penjualan->hasMorePages())
                                                <li class="page-item"><a class="page-link" href="{{ $penjualan->nextPageUrl() }}">&raquo;</a></li>
                                            @else
                                                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                            @endif
                                        </ul>
                                    </nav>
                                    <div class="text-muted small ms-1 mb-2 mb-md-0">
                                        Menampilkan {{ $penjualan->firstItem() }} - {{ $penjualan->lastItem() }} dari {{ $penjualan->total() }} data
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

{{-- Modal Detail Diletakkan di luar tabel --}}
@foreach($penjualan as $item)
    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Pesanan #{{ $item->no_pemesanan }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Order Summary Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item->details as $detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/'.$detail->obat->foto1) }}" 
                                                     alt="obat" width="48" class="me-2 rounded">
                                                <span>{{ $detail->obat->nama_obat }}</span>
                                            </div>
                                        </td>
                                        <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                                        <td>{{ $detail->jumlah_beli }}</td>
                                        <td>Rp {{ number_format($detail->harga_beli * $detail->jumlah_beli, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Details -->
                    <div class="row mt-4">
                        <!-- Customer Info -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Informasi Pelanggan</h6>
                            <p class="mb-1">Nama: {{ $item->pelanggan->nama_pelanggan }}</p>
                            <p class="mb-1">Email: {{ $item->pelanggan->email }}</p>
                            <p class="mb-1">No HP: {{ $item->pelanggan->no_telp }}</p>
                        </div>
                        
                        <!-- Order Info -->
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Informasi Pesanan</h6>
                            <p class="mb-1">No Transaksi: {{ $item->no_pemesanan }}</p>
                            <p class="mb-1">Tanggal: {{ $item->created_at->format('d M Y H:i') }}</p>
                            <p class="mb-1">Metode Pembayaran: {{ $item->metodeBayar->metode_pembayaran }}</p>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <span class="fw-bold">Rp {{ number_format($item->details->sum('subtotal'), 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Ongkos Kirim:</span>
                            <span>Rp {{ number_format($item->ongkos_kirim, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Biaya Aplikasi:</span>
                            <span>Rp {{ number_format($item->biaya_app, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2 pt-2 border-top">
                            <span class="fw-bold">Total:</span>
                            <span class="fw-bold text-info">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Prescription Image -->
                    @if($item->url_resep)
                        <div class="mt-4">
                            <h6 class="fw-bold mb-3">Resep Dokter</h6>
                            <img src="{{ asset('storage/'.$item->url_resep) }}" 
                                 alt="resep" class="img-fluid rounded" 
                                 style="max-height: 200px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- Add Modal for Status Description --}}
@foreach($penjualan as $item)
    <div class="modal fade" id="keteranganModal-{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Keterangan Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('penjualan.updateKeterangan', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Status Saat Ini</label>
                            <input type="text" class="form-control" value="{{ $item->status_order }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan Status</label>
                            <textarea name="keterangan_status" class="form-control" rows="3">{{ $item->keterangan_status }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Approve button
        document.querySelectorAll('.btn-approve').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Setujui Pesanan?',
                    text: "Status pesanan akan diubah menjadi Diproses",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Setujui!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Reject button
        document.querySelectorAll('.btn-reject').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Tolak Pesanan?',
                    text: "Status pesanan akan diubah menjadi Dibatalkan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Tolak!',
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
