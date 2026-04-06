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
                                <h4 class="card-title">Data Pemasukan (Transaksi Pembayaran)</h4>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <!-- Summary Cards -->
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h5 class="card-title text-muted">Total Transaksi</h5>
                                                <h3 class="text-primary">{{ $pemasukan->total() }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h5 class="card-title text-muted">Total Pemasukan</h5>
                                                <h3 class="text-success">Rp {{ number_format($pemasukan->sum(function($item) { return $item->total_bayar; }), 0, ',', '.') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h5 class="card-title text-muted">Biaya Pengiriman</h5>
                                                <h3 class="text-info">Rp {{ number_format($pemasukan->sum('ongkos_kirim'), 0, ',', '.') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <h5 class="card-title text-muted">Biaya Platform</h5>
                                                <h3 class="text-warning">Rp {{ number_format($pemasukan->sum('biaya_app'), 0, ',', '.') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 5%">No</th>
                                                <th style="width: 15%">No Transaksi</th>
                                                <th style="width: 15%">Pelanggan</th>
                                                <th style="width: 12%">Email</th>
                                                <th style="width: 12%">Total Bayar</th>
                                                <th style="width: 10%">Ongkos Kirim</th>
                                                <th style="width: 8%">Status</th>
                                                <th style="width: 15%">Tanggal</th>
                                                <th style="width: 8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($pemasukan as $index => $item)
                                                <tr>
                                                    <td>{{ ($pemasukan->currentPage() - 1) * $pemasukan->perPage() + $index + 1 }}</td>
                                                    <td>
                                                        <strong>{{ $item->no_pemesanan }}</strong>
                                                    </td>
                                                    <td>
                                                        {{ $item->pelanggan->nama_pelanggan ?? '-' }}
                                                    </td>
                                                    <td>
                                                        <small class="text-muted">{{ $item->pelanggan->email ?? '-' }}</small>
                                                    </td>
                                                    <td>
                                                        <strong class="text-success">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</strong>
                                                    </td>
                                                    <td>
                                                        <small>Rp {{ number_format($item->ongkos_kirim, 0, ',', '.') }}</small>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $statusClass = match($item->status_order) {
                                                                'Sudah Dibayarkan' => 'badge bg-success',
                                                                'Diproses' => 'badge bg-info',
                                                                'Selesai' => 'badge bg-primary',
                                                                default => 'badge bg-secondary'
                                                            };
                                                        @endphp
                                                        <span class="{{ $statusClass }}">{{ $item->status_order }}</span>
                                                    </td>
                                                    <td>
                                                        {{ $item->created_at->format('d/m/Y H:i') }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#detailModal{{ $item->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center text-muted py-4">
                                                        <i class="fas fa-inbox" style="font-size: 32px; opacity: 0.5;"></i>
                                                        <p class="mt-2">Belum ada data pemasukan</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $pemasukan->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals Container -->
@foreach($pemasukan as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detail Transaksi {{ $item->no_pemesanan }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Informasi Pelanggan</h6>
                        <table class="table table-sm">
                            <tr>
                                <td style="width: 40%;"><strong>Nama:</strong></td>
                                <td>{{ $item->pelanggan->nama_pelanggan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $item->pelanggan->email ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>No Telp:</strong></td>
                                <td>{{ $item->pelanggan->no_telp ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Informasi Transaksi</h6>
                        <table class="table table-sm">
                            <tr>
                                <td style="width: 40%;"><strong>No Transaksi:</strong></td>
                                <td>{{ $item->no_pemesanan }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal:</strong></td>
                                <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td><span class="badge bg-success">{{ $item->status_order }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <h6 class="text-muted">Detail Obat</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Obat</th>
                                <th style="width: 10%">Qty</th>
                                <th style="width: 15%">Harga</th>
                                <th style="width: 15%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($item->details as $detail)
                                <tr>
                                    <td>{{ $detail->obat->nama_obat ?? '-' }}</td>
                                    <td>{{ $detail->jumlah_beli }}</td>
                                    <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->harga_beli * $detail->jumlah_beli, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada detail obat</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6 offset-md-6">
                        <table class="table table-sm">
                            <tr>
                                <td><strong>Subtotal Obat:</strong></td>
                                <td class="text-end">
                                    <strong>Rp {{ number_format($item->details->sum(function($d) { return $d->harga_beli * $d->jumlah_beli; }), 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Ongkos Kirim:</strong></td>
                                <td class="text-end">
                                    <strong>Rp {{ number_format($item->ongkos_kirim, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Biaya Platform:</strong></td>
                                <td class="text-end">
                                    <strong>Rp {{ number_format($item->biaya_app, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                            <tr class="table-active">
                                <td><strong>Total Bayar:</strong></td>
                                <td class="text-end">
                                    <strong class="text-success" style="font-size: 16px;">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($item->keterangan_status)
                    <div class="alert alert-info mt-3">
                        <strong>Keterangan:</strong> {{ $item->keterangan_status }}
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 11px;
        padding: 5px 8px;
    }

    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
</style>
@endsection
