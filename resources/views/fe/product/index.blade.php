@extends('fe.master')

@section('navbar')
    @include('fe.navbar')
@endsection

@section('nav-product')

{{-- ===== Hero Banner ===== --}}
<div class="plist-hero">
    <div class="plist-hero__bg-orb plist-hero__bg-orb--1"></div>
    <div class="plist-hero__bg-orb plist-hero__bg-orb--2"></div>
    <div class="plist-hero__grid"></div>
    <div class="container position-relative" style="z-index:2;">
        <div class="plist-hero__inner">
            <div class="plist-hero__text">
                <div class="plist-hero__eyebrow">
                    <span class="plist-hero__eyebrow-dot"></span>
                    Apotek Online Medicare
                </div>
                <h1 class="plist-hero__title">
                    Temukan <span class="plist-hero__title-accent">Produk Kesehatan</span> Terbaik
                </h1>
                <p class="plist-hero__desc">
                    Obat-obatan, vitamin, suplemen, dan alat kesehatan berkualitas untuk keluarga Anda — harga terjangkau, stok lengkap.
                </p>
                <div class="plist-hero__badges">
                    <span class="plist-hero__badge"><i class="fas fa-shipping-fast"></i> Pengiriman Cepat</span>
                    <span class="plist-hero__badge"><i class="fas fa-shield-alt"></i> Produk Original</span>
                    <span class="plist-hero__badge"><i class="fas fa-tag"></i> Harga Terjangkau</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ===== Product List ===== --}}
<div class="plist-main">
    <div class="container">

        {{-- Filter bar --}}
        <div class="plist-filter">
            <div class="plist-filter__select-wrap">
                <span class="plist-filter__icon"><i class="fas fa-layer-group"></i></span>
                <select id="jenisObatDropdown" class="plist-filter__select">
                    <option value="all">Semua Kategori</option>
                    @foreach ($jenis_obats as $jenis)
                        <option value="tab-{{ $jenis->id }}">{{ $jenis->jenis }}</option>
                    @endforeach
                </select>
            </div>
            <div class="plist-filter__search-wrap">
                <span class="plist-filter__icon"><i class="fas fa-search"></i></span>
                <input type="text" id="searchObatInput" class="plist-filter__search" placeholder="Cari nama produk...">
            </div>
            <div class="plist-filter__count" id="plist-count"></div>
        </div>

        {{-- Grid --}}
        <div class="tab-content">
            <div id="tab-all" class="tab-pane fade show active">
                <div class="plist-grid" id="plist-grid-all">
                    @if ($obats->count() > 0)
                        @foreach ($obats as $item)
                            <div class="plist-card-wrap obat-item"
                                 data-nama="{{ strtolower($item->nama_obat) }}"
                                 data-jenis="tab-{{ $item->id_jenis }}">
                                <div class="prod-card">
                                    {{-- Image --}}
                                    <div class="prod-card__img-wrap">
                                        <img class="prod-card__img"
                                             src="{{ asset('storage/' . $item->foto1) }}"
                                             alt="{{ $item->nama_obat }}"
                                             onerror="this.src='{{ asset('fe/img/default.jpg') }}'">

                                        @if ($item->stok > 0)
                                            <div class="prod-card__badge prod-card__badge--available">
                                                <i class="fas fa-check-circle"></i> Tersedia ({{ $item->stok }})
                                            </div>
                                        @else
                                            <div class="prod-card__badge prod-card__badge--empty">
                                                <i class="fas fa-times-circle"></i> Stok Habis
                                            </div>
                                        @endif

                                        @if(optional($item->jenis_obat)->is_keras)
                                            <div class="plist-badge-keras">
                                                <i class="fas fa-exclamation-triangle"></i> Keras
                                            </div>
                                        @endif

                                        <div class="prod-card__overlay">
                                            <a class="prod-card__overlay-btn" href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#detailModal-{{ $item->id }}">
                                                <i class="fas fa-eye"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>

                                    {{-- Body --}}
                                    <div class="prod-card__body">
                                        <div class="prod-card__category">
                                            <i class="fas fa-tag"></i>
                                            {{ optional($item->jenis_obat)->jenis ?? '-' }}
                                        </div>
                                        <h3 class="prod-card__name">{{ $item->nama_obat }}</h3>
                                        <div class="prod-card__price">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="prod-card__actions">
                                        <a class="prod-card__action-btn prod-card__action-btn--detail"
                                           href="#" data-bs-toggle="modal"
                                           data-bs-target="#detailModal-{{ $item->id }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                        @if(session('pelanggan'))
                                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form prod-card__action-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <button type="submit" class="prod-card__action-btn prod-card__action-btn--cart">
                                                    <i class="fas fa-shopping-bag"></i> Keranjang
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="prod-card__action-btn prod-card__action-btn--cart btn-cart-guest">
                                                <i class="fas fa-shopping-bag"></i> Keranjang
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="plist-empty">
                            <i class="fas fa-box-open plist-empty__icon"></i>
                            <p class="plist-empty__text">Tidak ada produk tersedia.</p>
                        </div>
                    @endif
                </div>

                {{-- No results message --}}
                <div class="plist-empty" id="plist-no-results" style="display:none;">
                    <i class="fas fa-search plist-empty__icon"></i>
                    <p class="plist-empty__text">Produk tidak ditemukan. Coba kata kunci lain.</p>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ===== Modals (di luar container) ===== --}}
@foreach ($obats as $item)
    <div class="modal fade prod-modal" id="detailModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content prod-modal__content">
                <div class="prod-modal__header">
                    <div class="prod-modal__header-info">
                        <span class="prod-modal__header-category">
                            <i class="fas fa-capsules me-1"></i>
                            {{ optional($item->jenis_obat)->jenis ?? '-' }}
                            @if(optional($item->jenis_obat)->is_keras)
                                <span class="plist-badge-keras plist-badge-keras--inline ms-2">
                                    <i class="fas fa-exclamation-triangle"></i> Keras
                                </span>
                            @endif
                        </span>
                        <h5 class="prod-modal__title">{{ $item->nama_obat }}</h5>
                    </div>
                    <button type="button" class="prod-modal__close" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="prod-modal__body">
                    <div class="prod-modal__gallery">
                        <div id="carousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner prod-modal__carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/' . $item->foto1) }}" class="d-block w-100" alt="Foto 1"
                                         onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                </div>
                                @if($item->foto2)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $item->foto2) }}" class="d-block w-100" alt="Foto 2"
                                             onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                    </div>
                                @endif
                                @if($item->foto3)
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/' . $item->foto3) }}" class="d-block w-100" alt="Foto 3"
                                             onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                    </div>
                                @endif
                            </div>
                            @if($item->foto2 || $item->foto3)
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="prod-modal__info">
                        @if($item->stok > 0)
                            <div class="prod-modal__stock prod-modal__stock--available">
                                <i class="fas fa-check-circle"></i> Tersedia ({{ $item->stok }} unit)
                            </div>
                        @else
                            <div class="prod-modal__stock prod-modal__stock--empty">
                                <i class="fas fa-times-circle"></i> Stok Habis
                            </div>
                        @endif
                        <div class="prod-modal__label">Harga</div>
                        <div class="prod-modal__price">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</div>
                        <div class="prod-modal__label">Deskripsi</div>
                        <p class="prod-modal__desc">{{ $item->deskripsi_obat }}</p>
                        <div class="prod-modal__cta">
                            @if(session('pelanggan'))
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                    <button type="submit" class="prod-modal__cta-btn">
                                        <i class="fas fa-shopping-bag me-2"></i>Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <button type="button" class="prod-modal__cta-btn btn-cart-guest">
                                    <i class="fas fa-shopping-bag me-2"></i>Tambah ke Keranjang
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ---- Filter & Search ----
    const dropdown   = document.getElementById('jenisObatDropdown');
    const searchInput = document.getElementById('searchObatInput');
    const allItems   = document.querySelectorAll('.obat-item');
    const noResults  = document.getElementById('plist-no-results');
    const countEl    = document.getElementById('plist-count');

    function filterItems() {
        const selectedJenis = dropdown.value;
        const searchText    = searchInput.value.toLowerCase().trim();
        let visible = 0;

        allItems.forEach(item => {
            const matchJenis  = selectedJenis === 'all' || item.dataset.jenis === selectedJenis;
            const matchSearch = item.dataset.nama.includes(searchText);
            const show = matchJenis && matchSearch;
            item.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        noResults.style.display = visible === 0 ? 'flex' : 'none';
        countEl.textContent = visible + ' produk ditemukan';
    }

    dropdown.addEventListener('change', filterItems);
    searchInput.addEventListener('input', filterItems);
    filterItems();

    // ---- Guest cart ----
    document.querySelectorAll('.btn-cart-guest').forEach(btn => {
        btn.addEventListener('click', () => {
            Swal.fire({
                icon: 'info',
                title: 'Login Diperlukan',
                text: 'Silakan login atau register untuk menambah ke keranjang.',
                showCancelButton: true,
                confirmButtonText: 'Login',
                cancelButtonText: 'Register',
                confirmButtonColor: '#0dcaf0',
                reverseButtons: true
            }).then(result => {
                if (result.isConfirmed) window.location.href = "{{ route('pelanggan.login') }}";
                else if (result.dismiss === Swal.DismissReason.cancel) window.location.href = "{{ route('pelanggan.register') }}";
            });
        });
    });

    // ---- AJAX Add to Cart ----
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: new FormData(form)
            })
            .then(r => r.json().catch(() => r.text()))
            .then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Produk berhasil ditambahkan ke keranjang.',
                    showCancelButton: true,
                    confirmButtonText: 'Lihat Keranjang',
                    cancelButtonText: 'Lanjut Belanja',
                    confirmButtonColor: '#0dcaf0',
                    reverseButtons: true
                }).then(result => {
                    if (result.isConfirmed) window.location.href = "{{ route('cart.index') }}";
                });
            })
            .catch(() => Swal.fire('Gagal', 'Terjadi kesalahan, coba lagi.', 'error'));
        });
    });
});
</script>
@endpush

@endsection

@section('footer')
    @include('fe.footer')
@endsection