<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile | {{ $pelanggan->nama_pelanggan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fe/css/style.css') }}">
</head>
<body class="prf-body">

    {{-- Back button --}}
    <a href="/" class="prf-back-btn">
        <i class="fas fa-arrow-left"></i>
        <span>Beranda</span>
    </a>

    {{-- ===== Page Hero ===== --}}
    <div class="prf-hero">
        <div class="prf-hero__bg-orb prf-hero__bg-orb--1"></div>
        <div class="prf-hero__bg-orb prf-hero__bg-orb--2"></div>
        <div class="prf-hero__grid"></div>
        <div class="container position-relative" style="z-index:2;">
            <div class="prf-hero__content">
                <div class="prf-hero__avatar-wrap">
                    <img src="{{ $pelanggan->foto ? asset('storage/'.$pelanggan->foto) : asset('fe/img/default-profile.png') }}"
                         alt="Foto Profil"
                         class="prf-hero__avatar"
                         id="preview-foto">
                    <div class="prf-hero__avatar-online"></div>
                </div>
                <div class="prf-hero__info">
                    <div class="prf-hero__eyebrow">
                        <span class="prf-hero__eyebrow-dot"></span>
                        Akun Pelanggan
                    </div>
                    <h1 class="prf-hero__name">{{ $pelanggan->nama_pelanggan }}</h1>
                    <p class="prf-hero__email"><i class="fas fa-envelope me-2"></i>{{ $pelanggan->email }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Form Area ===== --}}
    <div class="prf-main">
        <div class="container">
            <div class="prf-layout">

                {{-- Success alert --}}
                @if(session('success'))
                    <div class="prf-alert prf-alert--success">
                        <i class="fas fa-check-circle prf-alert__icon"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('profile.update', $pelanggan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ===== SECTION: Info Dasar ===== --}}
                    <div class="prf-card">
                        <div class="prf-card__header">
                            <span class="prf-card__header-icon"><i class="fas fa-user"></i></span>
                            <h2 class="prf-card__title">Informasi Dasar</h2>
                        </div>
                        <div class="prf-card__body">
                            <div class="prf-avatar-row">
                                {{-- Photo upload --}}
                                <div class="prf-photo-block">
                                    <div class="prf-photo-block__img-wrap">
                                        <img src="{{ $pelanggan->foto ? asset('storage/'.$pelanggan->foto) : asset('fe/img/default-profile.png') }}"
                                             alt="Foto Profil"
                                             class="prf-photo-block__img"
                                             id="preview-foto-2">
                                        <label for="foto-input" class="prf-photo-block__overlay">
                                            <i class="fas fa-camera"></i>
                                            <span>Ganti Foto</span>
                                        </label>
                                        <input type="file" id="foto-input" name="foto" accept="image/*" onchange="previewImage(this)" style="display:none;">
                                    </div>
                                    <p class="prf-photo-block__hint">JPG, PNG · Maks 2MB</p>
                                </div>

                                {{-- Fields --}}
                                <div class="prf-fields-col">
                                    <div class="prf-field">
                                        <label class="prf-field__label" for="nama_pelanggan">Nama Lengkap</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-user"></i></span>
                                            <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                                   class="prf-field__input"
                                                   value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label" for="email">Email</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-envelope"></i></span>
                                            <input type="email" id="email" name="email"
                                                   class="prf-field__input"
                                                   value="{{ old('email', $pelanggan->email) }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label" for="no_telp">No. Telepon</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-phone"></i></span>
                                            <input type="text" id="no_telp" name="no_telp"
                                                   class="prf-field__input"
                                                   value="{{ old('no_telp', $pelanggan->no_telp) }}">
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label" for="katakunci">
                                            Password
                                            <span class="prf-field__label-hint">Kosongkan jika tidak ingin mengubah</span>
                                        </label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-lock"></i></span>
                                            <input type="password" id="katakunci" name="katakunci"
                                                   class="prf-field__input prf-field__input--pw"
                                                   placeholder="Isi jika ingin mengganti password">
                                            <button type="button" class="prf-field__toggle-pw" id="togglePw">
                                                <i class="fas fa-eye" id="togglePwIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== SECTION: Alamat Utama ===== --}}
                    <div class="prf-card">
                        <div class="prf-card__header">
                            <span class="prf-card__header-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <h2 class="prf-card__title">Alamat Utama</h2>
                            <span class="prf-card__header-badge prf-card__header-badge--primary">Wajib</span>
                        </div>
                        <div class="prf-card__body">
                            <div class="prf-grid-2">
                                <div class="prf-field prf-field--full">
                                    <label class="prf-field__label">Alamat</label>
                                    <div class="prf-field__wrap">
                                        <span class="prf-field__icon"><i class="fas fa-home"></i></span>
                                        <input type="text" name="alamat1" class="prf-field__input"
                                               value="{{ old('alamat1', $pelanggan->alamati) }}" required>
                                    </div>
                                </div>
                                <div class="prf-field">
                                    <label class="prf-field__label">Kota</label>
                                    <div class="prf-field__wrap">
                                        <span class="prf-field__icon"><i class="fas fa-city"></i></span>
                                        <input type="text" name="kota1" class="prf-field__input"
                                               value="{{ old('kota1', $pelanggan->kota1) }}" required>
                                    </div>
                                </div>
                                <div class="prf-field">
                                    <label class="prf-field__label">Provinsi</label>
                                    <div class="prf-field__wrap">
                                        <span class="prf-field__icon"><i class="fas fa-map"></i></span>
                                        <input type="text" name="propinsi1" class="prf-field__input"
                                               value="{{ old('propinsi1', $pelanggan->propinsti) }}" required>
                                    </div>
                                </div>
                                <div class="prf-field">
                                    <label class="prf-field__label">Kode Pos</label>
                                    <div class="prf-field__wrap">
                                        <span class="prf-field__icon"><i class="fas fa-mail-bulk"></i></span>
                                        <input type="text" name="kodepos1" class="prf-field__input"
                                               value="{{ old('kodepos1', $pelanggan->kodepos1) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== SECTION: Alamat Lainnya ===== --}}
                    <div class="prf-card">
                        <div class="prf-card__header">
                            <span class="prf-card__header-icon"><i class="fas fa-map-marked-alt"></i></span>
                            <h2 class="prf-card__title">Alamat Lainnya</h2>
                            <span class="prf-card__header-badge">Opsional</span>
                        </div>
                        <div class="prf-card__body">
                            {{-- Alamat 2 --}}
                            <div class="prf-address-group">
                                <div class="prf-address-group__label">Alamat 2</div>
                                <div class="prf-grid-2">
                                    <div class="prf-field prf-field--full">
                                        <label class="prf-field__label">Alamat</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-home"></i></span>
                                            <input type="text" name="alamat2" class="prf-field__input"
                                                   value="{{ old('alamat2', $pelanggan->alamai2) }}">
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label">Kota</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-city"></i></span>
                                            <input type="text" name="kota2" class="prf-field__input"
                                                   value="{{ old('kota2', $pelanggan->kota2) }}">
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label">Provinsi</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-map"></i></span>
                                            <input type="text" name="propinsi2" class="prf-field__input"
                                                   value="{{ old('propinsi2', $pelanggan->propinsi2) }}">
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label">Kode Pos</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-mail-bulk"></i></span>
                                            <input type="text" name="kodepos2" class="prf-field__input"
                                                   value="{{ old('kodepos2', $pelanggan->kodepos2) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="prf-address-divider"></div>

                            {{-- Alamat 3 --}}
                            <div class="prf-address-group">
                                <div class="prf-address-group__label">Alamat 3</div>
                                <div class="prf-grid-2">
                                    <div class="prf-field prf-field--full">
                                        <label class="prf-field__label">Alamat</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-home"></i></span>
                                            <input type="text" name="alamat3" class="prf-field__input"
                                                   value="{{ old('alamat3', $pelanggan->alamai3) }}">
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label">Kota</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-city"></i></span>
                                            <input type="text" name="kota3" class="prf-field__input"
                                                   value="{{ old('kota3', $pelanggan->kota3) }}">
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label">Provinsi</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-map"></i></span>
                                            <input type="text" name="propinsi3" class="prf-field__input"
                                                   value="{{ old('propinsi3', $pelanggan->propinsi3) }}">
                                        </div>
                                    </div>
                                    <div class="prf-field">
                                        <label class="prf-field__label">Kode Pos</label>
                                        <div class="prf-field__wrap">
                                            <span class="prf-field__icon"><i class="fas fa-mail-bulk"></i></span>
                                            <input type="text" name="kodepos3" class="prf-field__input"
                                                   value="{{ old('kodepos3', $pelanggan->kodepos3) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ===== SECTION: KTP ===== --}}
                    <div class="prf-card">
                        <div class="prf-card__header">
                            <span class="prf-card__header-icon"><i class="fas fa-id-card"></i></span>
                            <h2 class="prf-card__title">KTP</h2>
                            <span class="prf-card__header-badge">Opsional</span>
                        </div>
                        <div class="prf-card__body">
                            <div class="prf-ktp">
                                <div class="prf-field">
                                    <label class="prf-field__label">Upload KTP</label>
                                    <div class="prf-field__wrap">
                                        <span class="prf-field__icon"><i class="fas fa-cloud-upload-alt"></i></span>
                                        <input type="file" name="url_ktp" class="prf-field__input" accept="image/*">
                                    </div>
                                    <p class="prf-field__hint">Format: JPG, PNG · Maks 2MB</p>
                                </div>
                                @if($pelanggan->url_ktp)
                                    <div class="prf-ktp__preview">
                                        <p class="prf-ktp__preview-label">KTP Terdaftar</p>
                                        <img src="{{ asset('storage/'.$pelanggan->url_ktp) }}"
                                             alt="KTP" class="prf-ktp__img">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="prf-submit-row">
                        <button type="submit" class="prf-submit-btn">
                            <i class="fas fa-save me-2"></i>
                            Simpan Perubahan
                            <i class="fas fa-arrow-right prf-submit-btn__arrow"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview foto — update both hero & card avatar
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-foto').src   = e.target.result;
                    document.getElementById('preview-foto-2').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Toggle password visibility
        document.getElementById('togglePw').addEventListener('click', function () {
            const input = document.getElementById('katakunci');
            const icon  = document.getElementById('togglePwIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
    </script>
</body>
</html>