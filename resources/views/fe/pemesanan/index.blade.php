@extends('fe.master')
@section('navbar')
    @include('fe.navbar')
@endsection

@section('checkout')
<style>
    /* Tombol filter nav pills bulat */
    .nav-pills .nav-link {
        border-radius: 999px !important;
        padding-left: 2rem;
        padding-right: 2rem;
        font-weight: 600;
        transition: background 0.2s, color 0.2s, border 0.2s;
    }
    .nav-pills .nav-link.active,
    .nav-pills .nav-link:focus {
        box-shadow: 0 2px 8px rgba(13,202,240,0.10);
    }
    .nav-pills .nav-link {
        border-width: 2px;
    }

    /* Card pesanan rounded */
    .order-card-rounded {
        border-radius: 32px !important;
        overflow: hidden;
        border: 2px solid #0dcaf0;
        background: #eaf8fc;
        margin-bottom: 2rem;
        box-shadow: 0 4px 24px rgba(13,202,240,0.07);
    }
    /* Header pesanan rounded */
    .order-header-rounded {
        border-radius: 32px 32px 0 0 !important;
        background: #b6e6fb;
        border-bottom: 1.5px solid #0dcaf0;
        padding-top: 1.2rem;
        padding-bottom: 1.2rem;
    }
    /* Table rounded */
    .table-rounded {
        border-radius: 0 0 32px 32px !important;
        overflow: hidden;
        background: #eaf8fc;
        margin-bottom: 0;
    }
    .table-rounded thead tr th {
        background: #0dcaf0 !important;
        color: #fff !important;
        border-top: none;
        border-bottom: none;
    }
    .table-rounded tr, .table-rounded td, .table-rounded th {
        border: none !important;
    }
    .table-rounded tbody tr {
        border-bottom: 1px solid #d0f0fa !important;
    }
    .table-rounded tbody tr:last-child {
        border-bottom: none !important;
    }
    /* Tombol aksi pesanan biru */
    .btn-order-action {
        border-radius: 999px !important;
        font-weight: 600;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        background: #0dcaf0 !important;
        color: #fff !important;
        border: none;
        transition: background 0.2s, color 0.2s;
    }
    .btn-order-action:hover {
        background: #0a6fa7 !important;
        color: #fff !important;
    }

    /* Action button styles */
    .btn-cancel {
        border-radius: 999px !important;
        font-weight: 600;
        padding: 8px 24px;
        background: #FFE5E5;
        color: #DC3545;
        border: 1.5px solid #DC3545;
        transition: all 0.2s ease;
    }
    
    .btn-cancel:hover {
        background: #DC3545;
        color: #fff;
    }

    /* Status badge styles */
    .status-badge {
        font-size: 0.85rem;
        padding: 8px 16px;
        border-radius: 999px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .status-badge i {
        font-size: 0.9rem;
    }
    
    .status-dibatalkan {
        background: #FFE5E5;
        color: #DC3545;
        border: 1.5px solid #DC3545;
    }
    
    .status-menunggu {
        background: #FFF8E5;
        color: #FFC107;
        border: 1.5px solid #FFC107;
    }
    
    .status-diproses {
        background: #E5F6FF;
        color: #0DCAF0;
        border: 1.5px solid #0DCAF0;
    }
    
    .status-dikirim {
        background: #E5F0FF;
        color: #0D6EFD;
        border: 1.5px solid #0D6EFD;
    }
    
    .status-selesai {
        background: #E5F6FF;
        color: #0DCAF0;
        border: 1.5px solid #0DCAF0;
    }

    /* Filter dropdown styles */
    .filter-dropdown {
        background: #fff;
        border: 2px solid #0dcaf0;
        border-radius: 999px;
        padding: 8px 20px;
        font-weight: 600;
        color: #0dcaf0;
        transition: all 0.2s;
    }
    
    .filter-dropdown:hover, 
    .filter-dropdown:focus {
        background: #eaf8fc;
        box-shadow: 0 2px 8px rgba(13,202,240,0.15);
    }
    
    .filter-dropdown::after {
        color: #0dcaf0;
    }
    
    .filter-menu {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(13,202,240,0.12);
        padding: 8px;
    }
    
    .filter-menu .dropdown-item {
        border-radius: 8px;
        padding: 8px 16px;
        transition: all 0.2s;
    }
    
    .filter-menu .dropdown-item:hover {
        background: #eaf8fc;
    }
    
    .filter-menu .dropdown-item i {
        width: 20px;
    }
    
    .filter-menu .dropdown-divider {
        margin: 8px 0;
        border-color: #e0f7fa;
    }

    /* New table styles */
    .order-table {
        width: 100%;
        background: #fff;
        border-radius: 16px;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .order-table thead th {
        background: #0dcaf0;
        color: #fff;
        font-weight: 600;
        padding: 15px;
        font-size: 0.95rem;
        border: none;
    }

    .order-table tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #e0f7fa;
        vertical-align: middle;
    }

    .order-table tbody tr:last-child td {
        border-bottom: none;
    }

    .order-table tbody tr:hover {
        background-color: #f8fdfe;
    }

    .product-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .product-image {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
    }

    .product-name {
        font-weight: 600;
        color: #2d3436;
    }

    .price-cell {
        font-family: 'Fira Mono', monospace;
        color: #0a6fa7;
        font-weight: 500;
    }

    .action-cell {
        text-align: right;
    }

    .btn-group {
        display: inline-flex;
        gap: 8px;
    }

    .price-summary {
        background: #fff;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 2px 12px rgba(13,202,240,0.08);
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        color: #64748b;
        font-size: 0.95rem;
    }

    .price-total {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 2px dashed #e2e8f0;
    }

    .price-total .price-row {
        color: #0a6fa7;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .price-value {
        font-family: 'Fira Mono', monospace;
        color: #0dcaf0;
        font-weight: 500;
    }

    .price-total .price-value {
        font-size: 1.25rem;
        font-weight: 700;
        background: linear-gradient(135deg, #0dcaf0, #0a6fa7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
<div class="container py-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="mb-0">Daftar Pemesanan</h2>
        <div class="dropdown">
            <button class="filter-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-filter me-2"></i>
                {{ request('status') ?: 'Semua Status' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end filter-menu">
                <li>
                    <a class="dropdown-item {{ !request('status') ? 'active' : '' }}" href="{{ route('pemesanan.index') }}">
                        <i class="fas fa-list-ul"></i> Semua Status
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item {{ request('status') == 'Menunggu Konfirmasi' ? 'active' : '' }}" 
                       href="?status=Menunggu Konfirmasi">
                        <i class="fas fa-clock text-warning"></i> Menunggu Konfirmasi
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request('status') == 'Diproses' ? 'active' : '' }}" 
                       href="?status=Diproses">
                        <i class="fas fa-cog text-info"></i> Diproses
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request('status') == 'Menunggu Kurir' ? 'active' : '' }}" 
                       href="?status=Menunggu Kurir">
                        <i class="fas fa-truck text-primary"></i> Menunggu Kurir
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request('status') == 'Dikirim' ? 'active' : '' }}" 
                       href="?status=Dikirim">
                        <i class="fas fa-shipping-fast text-primary"></i> Dikirim
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request('status') == 'Selesai' ? 'active' : '' }} text-info" 
                       href="?status=Selesai">
                        <i class="fas fa-check-circle text-info"></i> Selesai
                    </a>
                </li>
                <li>
                    <a class="dropdown-item {{ request('status') == 'Dibatalkan Pembeli' ? 'active' : '' }}" 
                       href="?status=Dibatalkan Pembeli">
                        <i class="fas fa-times-circle text-danger"></i> Dibatalkan
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div>
        @forelse($penjualans as $order)
            @php
                $isDibatalkan = in_array($order->status_order, ['Dibatalkan Pembeli', 'Dibatalkan Penjual']);
            @endphp
            @if(!request('status') || $order->status_order == request('status') || ($isDibatalkan && request('status') == 'Dibatalkan Pembeli'))
            <div class="order-card-rounded">
                <div class="d-flex flex-wrap justify-content-between align-items-center px-4 order-header-rounded">
                    <div>
                        <span class="fw-bold" style="color:#0a6fa7;">
                            {{ \Illuminate\Support\Carbon::parse($order->created_at)->format('d, M Y') }}
                        </span>
                        <span class="text-muted ms-2">- {{ $order->no_transaksi ?? $order->no_pemesanan ?? '-' }}</span>
                    </div>
                    <div>
                        @if($order->status_order == 'Menunggu Konfirmasi')
                            <span class="status-badge status-menunggu">
                                <i class="fas fa-clock"></i>
                                Menunggu Konfirmasi
                            </span>
                        @elseif($order->status_order == 'Diproses')
                            <span class="status-badge status-diproses">
                                <i class="fas fa-cog"></i>
                                Diproses
                            </span>
                        @elseif($order->status_order == 'Menunggu Kurir')
                            <span class="status-badge status-dikirim">
                                <i class="fas fa-truck"></i>
                                Menunggu Kurir
                            </span>
                        @elseif($order->status_order == 'Dikirim')
                            <span class="status-badge status-dikirim">
                                <i class="fas fa-shipping-fast"></i>
                                Dikirim
                            </span>
                        @elseif($order->status_order == 'Selesai')
                            <span class="status-badge status-info">
                                <i class="fas fa-check-circle"></i>
                                Selesai
                            </span>
                        @elseif($order->status_order == 'Dibatalkan Pembeli' || $order->status_order == 'Dibatalkan Penjual')
                            <span class="status-badge status-dibatalkan">
                                <i class="fas fa-times-circle"></i>
                                Dibatalkan
                            </span>
                        @elseif($order->status_order == 'Bermasalah')
                            <span class="status-badge status-dibatalkan">
                                <i class="fas fa-exclamation-circle"></i>
                                Bermasalah
                            </span>
                        @endif
                    </div>
                </div>
                <div class="table-responsive px-4 pt-3">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Status Pemesanan</th>
                                <th>Resep</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->details as $detail)
                            <tr>
                                <td>
                                    <div class="product-cell">
                                        <img src="{{ asset('storage/' . $detail->obat->foto1) }}" 
                                             alt="obat" class="product-image">
                                        <span class="product-name">{{ $detail->obat->nama_obat }}</span>
                                    </div>
                                </td>
                                <td>{{ $detail->jumlah_beli }} unit</td>
                                <td class="price-cell">Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-credit-card me-1"></i>
                                        {{ $order->metodeBayar->metode_pembayaran ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $statusClass = match($order->status_order) {
                                            'Menunggu Konfirmasi' => 'status-badge status-menunggu',
                                            'Diproses' => 'status-badge status-diproses',
                                            'Menunggu Kurir' => 'status-badge status-dikirim',
                                            'Dikirim' => 'status-badge status-dikirim',
                                            'Selesai' => 'status-badge status-selesai',
                                            'Dibatalkan Pembeli', 'Dibatalkan Penjual' => 'status-badge status-dibatalkan',
                                            default => 'status-badge'
                                        };
                                        $statusIcon = match($order->status_order) {
                                            'Menunggu Konfirmasi' => 'clock',
                                            'Diproses' => 'cog',
                                            'Menunggu Kurir' => 'truck',
                                            'Dikirim' => 'shipping-fast',
                                            'Selesai' => 'check-circle',
                                            'Dibatalkan Pembeli', 'Dibatalkan Penjual' => 'times-circle',
                                            default => 'info-circle'
                                        };
                                    @endphp
                                    <span class="{{ $statusClass }}">
                                        <i class="fas fa-{{ $statusIcon }}"></i>
                                        {{ $order->status_order }}
                                    </span>
                                    @if($order->keterangan_status)
                                        <br>
                                        <small class="text-muted mt-1 d-block">
                                            {{ $order->keterangan_status }}
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    @if($order->url_resep)
                                        <button class="btn btn-sm btn-light border-info text-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#resepModal{{ $order->id }}">
                                            <i class="fa fa-file-medical me-1"></i> Lihat Resep
                                        </button>
                                        <!-- Modal Resep -->
                                        <div class="modal fade" id="resepModal{{ $order->id }}" tabindex="-1" aria-labelledby="resepModalLabel{{ $order->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info text-white">
                                                        <h5 class="modal-title" id="resepModalLabel{{ $order->id }}">Resep Dokter</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/' . $order->url_resep) }}" alt="Resep" class="img-fluid rounded" style="max-height:400px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">
                                            <i class="fa fa-file-slash me-1"></i> Tidak ada resep
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-4 pb-3 pt-2">
                    <div class="mt-3" style="font-family: 'Fira Mono', monospace;">
                        <div class="price-summary">
                            <div class="price-row">
                                <span>Subtotal Produk</span>
                                <span class="price-value">
                                    Rp {{ number_format($order->details->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="price-row">
                                <span>Ongkos Kirim</span>
                                <span class="price-value">
                                    Rp {{ number_format($order->ongkos_kirim, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="price-row">
                                <span>Biaya Platform</span>
                                <span class="price-value">
                                    Rp {{ number_format($order->biaya_app, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="price-total">
                                <div class="price-row">
                                    <span>Total Pembayaran</span>
                                    <span class="price-value">
                                        Rp {{ number_format($order->total_bayar, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-flex justify-content-end gap-2">
                        @if($order->status_order == 'Menunggu Konfirmasi')
                            <button type="button" 
                                    class="btn btn-order-action"
                                    onclick="payWithMidtrans('{{ $order->id }}')">
                                <i class="fas fa-credit-card me-2"></i>Bayar Sekarang
                            </button>
                        @endif

                        @if($order->status_order == 'Menunggu Konfirmasi' || $order->status_order == 'Diproses')
                            <form action="{{ route('pemesanan.cancel', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-cancel">
                                    <i class="fas fa-times me-2"></i>Batalkan Pesanan
                                </button>
                            </form>
                        @endif

                        @if($order->status_order == 'Dibatalkan Pembeli' || $order->status_order == 'Dibatalkan Penjual')
                            <form action="{{ route('pemesanan.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i>Hapus
                                </button>
                            </form>
                        @endif

                        @if($order->status_order == 'Selesai')
                            <form action="{{ route('pemesanan.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash me-2"></i>Hapus
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @empty
            <div class="text-center py-5 text-muted">Belum ada pemesanan.</div>
        @endforelse
    </div>
</div>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
function payWithMidtrans(orderId) {
    // Fix the fetch syntax error
    fetch(`/midtrans/token/${orderId}`)
        .then(response => response.json())
        .then(data => {  // Remove => and fix the arrow function
            if (data.snap_token) {
                window.snap.pay(data.snap_token, {  // Add window. before snap
                    onSuccess: function(result) {
                        window.location.href = '{{ route('midtrans.finish') }}';
                    },
                    onPending: function(result) {
                        window.location.href = '{{ route('midtrans.unfinish') }}';
                    },
                    onError: function(result) {
                        window.location.href = '{{ route('midtrans.error') }}';
                    },
                    onClose: function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pembayaran Dibatalkan',
                            text: 'Anda menutup halaman pembayaran sebelum menyelesaikan transaksi'
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memproses pembayaran'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);  // Add error logging
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat memproses pembayaran'
            });
        });
}
</script>
@endsection

@section('footer')
    @include('fe.footer')
@endsection
