<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile | {{ $pelanggan->nama_pelanggan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding-top: 2rem;
        }
        .profile-header {
            background: linear-gradient(135deg, #0dcaf0 0%, #0d6efd 100%);
            padding: 2rem 1rem;
            margin-bottom: 2rem;
            border-radius: 1rem;
            color: white;
            box-shadow: 0 4px 15px rgba(13, 202, 240, 0.2);
        }
        .back-button {
            position: fixed;
            top: 1rem;
            left: 1rem;
            color: #0dcaf0;
            text-decoration: none;
            font-size: 1.2rem;
            background: white;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .back-button:hover {
            transform: translateX(-5px);
            color: #0d6efd;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }
        .card {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 4px 25px rgba(0,0,0,0.1);
        }
        .card-body {
            padding: 2rem;
        }
        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
        }
        .btn-info {
            border-radius: 0.75rem;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(13, 202, 240, 0.4);
        }
        .profile-image {
            position: relative;
            display: inline-block;
        }
        .profile-image img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .profile-image input[type="file"] {
            display: none;
        }
        .profile-upload-label {
            margin-top: 0.5rem;
            display: inline-block;
            padding: 0.25rem 1rem;
            background: #0dcaf0;
            color: white;
            border-radius: 1rem;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .profile-upload-label:hover {
            background: #0d6efd;
        }
        .section-title {
            color: #0dcaf0;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-text {
            color: #6c757d;
            font-size: 0.875rem;
        }
        hr {
            margin: 2rem 0;
            opacity: 0.1;
        }
    </style>
</head>
<body>
    <a href="/" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
    </a>

    <div class="container py-5">
        <div class="profile-header text-center mb-4">
            <h2>Profil Saya</h2>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <form action="{{ route('profile.update', $pelanggan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-4 align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="profile-image">
                                        <img src="{{ $pelanggan->foto ? asset('storage/'.$pelanggan->foto) : asset('fe/img/default-profile.png') }}"
                                            alt="Foto Profil" id="preview-foto">
                                        <label for="foto-input" class="profile-upload-label">
                                            <i class="fas fa-camera"></i> Pilih Foto
                                        </label>
                                        <input type="file" id="foto-input" name="foto" accept="image/*" onchange="previewImage(this)">
                                    </div>
                                    <small class="text-muted d-block mt-2">Format: jpg, png. Maks 2MB.</small>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $pelanggan->no_telp) }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kata Kunci (Password)</label>
                                        <input type="password" name="katakunci" class="form-control" placeholder="Isi jika ingin mengganti password">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3 text-info section-title">Alamat Utama</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="alamat1" class="form-control" value="{{ old('alamat1', $pelanggan->alamati) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota</label>
                                    <input type="text" name="kota1" class="form-control" value="{{ old('kota1', $pelanggan->kota1) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi</label>
                                    <input type="text" name="propinsi1" class="form-control" value="{{ old('propinsi1', $pelanggan->propinsti) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Pos</label>
                                    <input type="text" name="kodepos1" class="form-control" value="{{ old('kodepos1', $pelanggan->kodepos1) }}" required>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3 text-info section-title">Alamat Lainnya</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat 2</label>
                                    <input type="text" name="alamat2" class="form-control" value="{{ old('alamat2', $pelanggan->alamai2) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota 2</label>
                                    <input type="text" name="kota2" class="form-control" value="{{ old('kota2', $pelanggan->kota2) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi 2</label>
                                    <input type="text" name="propinsi2" class="form-control" value="{{ old('propinsi2', $pelanggan->propinsi2) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Pos 2</label>
                                    <input type="text" name="kodepos2" class="form-control" value="{{ old('kodepos2', $pelanggan->kodepos2) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Alamat 3</label>
                                    <input type="text" name="alamat3" class="form-control" value="{{ old('alamat3', $pelanggan->alamai3) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kota 3</label>
                                    <input type="text" name="kota3" class="form-control" value="{{ old('kota3', $pelanggan->kota3) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Provinsi 3</label>
                                    <input type="text" name="propinsi3" class="form-control" value="{{ old('propinsi3', $pelanggan->propinsi3) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kode Pos 3</label>
                                    <input type="text" name="kodepos3" class="form-control" value="{{ old('kodepos3', $pelanggan->kodepos3) }}">
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="form-label">KTP</label>
                                <input type="file" name="url_ktp" class="form-control" accept="image/*">
                                <small class="text-muted">Format: jpg, png. Maks 2MB.</small>
                                @if($pelanggan->url_ktp)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/'.$pelanggan->url_ktp) }}" alt="KTP" style="max-width: 200px">
                                    </div>
                                @endif
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-info px-4">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-foto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    </script>
</body>
</html>