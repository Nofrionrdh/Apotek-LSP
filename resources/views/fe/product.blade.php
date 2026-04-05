<div class="prod-section" id="product">
    <div class="container">

        {{-- ===== Section Header ===== --}}
        <div class="prod-header">
            <div class="prod-header__left">
                <div class="prod-header__eyebrow">
                    <span class="prod-header__eyebrow-dot"></span>
                    Produk Pilihan
                </div>
                <h2 class="prod-header__title">Produk Kesehatan <span class="prod-header__title-accent">Kami</span></h2>
                <p class="prod-header__desc">Kami menyediakan beragam produk kesehatan terbaik, mulai dari obat-obatan, vitamin, suplemen, hingga alat kesehatan, untuk mendukung kebutuhan Anda setiap hari.</p>
            </div>
            <div class="prod-header__right">
                <div class="prod-filter-tabs">
                    @foreach ($jenis_obats as $index => $jenis)
                        <a class="prod-filter-tab {{ $index === 0 ? 'is-active' : '' }}"
                           data-bs-toggle="pill"
                           href="#tab-{{ $jenis->id }}">
                            <i class="fas fa-capsules prod-filter-tab__icon"></i>
                            {{ $jenis->jenis }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== Tab Content ===== --}}
        <div class="tab-content">
            @foreach ($jenis_obats as $index => $jenis)
                <div id="tab-{{ $jenis->id }}" class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}">
                    @php $obat_list = $obats->where('id_jenis', $jenis->id); @endphp

                    @if ($obat_list->count() > 0)
                        <div class="prod-grid">
                            @foreach ($obat_list as $item)
                                <div class="prod-card">
                                    {{-- Image --}}
                                    <div class="prod-card__img-wrap">
                                        <img class="prod-card__img"
                                             src="{{ asset('storage/' . $item->foto1) }}"
                                             alt="{{ $item->nama_obat }}"
                                             onerror="this.src='{{ asset('fe/img/default.jpg') }}'">

                                        {{-- Stock badge --}}
                                        @if ($item->stok > 0)
                                            <div class="prod-card__badge prod-card__badge--available">
                                                <i class="fas fa-check-circle"></i>
                                                Tersedia ({{ $item->stok }})
                                            </div>
                                        @else
                                            <div class="prod-card__badge prod-card__badge--empty">
                                                <i class="fas fa-times-circle"></i>
                                                Stok Habis
                                            </div>
                                        @endif

                                        {{-- Hover overlay --}}
                                        <div class="prod-card__overlay">
                                            <a class="prod-card__overlay-btn"
                                               href="#"
                                               data-bs-toggle="modal"
                                               data-bs-target="#detailModal-{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                                Lihat Detail
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
                                        <div class="prod-card__price">
                                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="prod-card__actions">
                                        <a class="prod-card__action-btn prod-card__action-btn--detail"
                                           href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#detailModal-{{ $item->id }}">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>

                                        @if(session('pelanggan'))
                                            <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form prod-card__action-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <button type="submit" class="prod-card__action-btn prod-card__action-btn--cart">
                                                    <i class="fas fa-shopping-bag"></i>
                                                    Keranjang
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="prod-card__action-btn prod-card__action-btn--cart btn-cart-guest">
                                                <i class="fas fa-shopping-bag"></i>
                                                Keranjang
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                {{-- ===== Modal Detail ===== --}}
                                <div class="modal fade prod-modal" id="detailModal-{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content prod-modal__content">
                                            <div class="prod-modal__header">
                                                <div class="prod-modal__header-info">
                                                    <span class="prod-modal__header-category">
                                                        <i class="fas fa-capsules me-1"></i>
                                                        {{ optional($item->jenis_obat)->jenis ?? '-' }}
                                                    </span>
                                                    <h5 class="prod-modal__title">{{ $item->nama_obat }}</h5>
                                                </div>
                                                <button type="button" class="prod-modal__close" data-bs-dismiss="modal">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <div class="prod-modal__body">
                                                {{-- Carousel --}}
                                                <div class="prod-modal__gallery">
                                                    <div id="carousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                                        <div class="carousel-inner prod-modal__carousel-inner">
                                                            <div class="carousel-item active">
                                                                <img src="{{ asset('storage/' . $item->foto1) }}" class="d-block w-100" alt="Foto 1" onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                                            </div>
                                                            @if ($item->foto2)
                                                                <div class="carousel-item">
                                                                    <img src="{{ asset('storage/' . $item->foto2) }}" class="d-block w-100" alt="Foto 2" onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                                                </div>
                                                            @endif
                                                            @if ($item->foto3)
                                                                <div class="carousel-item">
                                                                    <img src="{{ asset('storage/' . $item->foto3) }}" class="d-block w-100" alt="Foto 3" onerror="this.src='{{ asset('fe/img/default.jpg') }}'">
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @if ($item->foto2 || $item->foto3)
                                                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $item->id }}" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>

                                                {{-- Info --}}
                                                <div class="prod-modal__info">
                                                    @if ($item->stok > 0)
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
                        </div>
                    @else
                        <div class="prod-empty">
                            <i class="fas fa-box-open prod-empty__icon"></i>
                            <p class="prod-empty__text">Tidak ada produk tersedia untuk <strong>{{ $jenis->jenis }}</strong></p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Guest cart
        document.querySelectorAll('.btn-cart-guest').forEach(function(btn) {
            btn.addEventListener('click', function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Login Diperlukan',
                    text: 'Silakan login atau register sebagai pelanggan untuk menambah ke keranjang.',
                    showCancelButton: true,
                    confirmButtonText: 'Login',
                    cancelButtonText: 'Register',
                    reverseButtons: true,
                    confirmButtonColor: '#0dcaf0',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('pelanggan.login') }}";
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = "{{ route('pelanggan.register') }}";
                    }
                });
            });
        });

        // AJAX Add to Cart
        document.querySelectorAll('.add-to-cart-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(form);
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(response => response.json().catch(() => response.text()))
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Produk berhasil ditambahkan ke keranjang.',
                        showCancelButton: true,
                        confirmButtonText: 'Lihat Keranjang',
                        cancelButtonText: 'Lanjut Belanja',
                        reverseButtons: true,
                        confirmButtonColor: '#0dcaf0',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('cart.index') }}";
                        }
                    });
                })
                .catch(() => {
                    Swal.fire('Gagal', 'Terjadi kesalahan, coba lagi.', 'error');
                });
            });
        });
    });
</script>
@endpush