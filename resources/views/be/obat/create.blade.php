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
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Tambah Obat</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('obat.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Obat</label>
                                                    <input type="text" class="form-control" name="nama_obat" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Obat</label>
                                                    <select name="id_jenis" class="form-control" required>
                                                        <option value="">Pilih Jenis Obat</option>
                                                        @foreach ($jenis_obat as $j)
                                                            <option value="{{ $j->id }}">{{ $j->jenis }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga</label>
                                                    <input type="number" class="form-control" name="harga_jual" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Stok</label>
                                                    <input type="number" class="form-control" name="stok" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi Obat</label>
                                                    <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Foto 1</label>
                                                    <div class="custom-file-container">
                                                        <div class="input-group">
                                                            <label class="input-group-text bg-primary text-white"
                                                                for="fileInput1">
                                                                Pilih Gambar
                                                            </label>
                                                            <input type="file" class="form-control" name="foto1"
                                                                id="fileInput1" accept="image/*"
                                                                onchange="previewImage(this, 'preview1')"
                                                                style="display: none;" required>
                                                            <input type="text" class="form-control" id="fileLabel1"
                                                                placeholder="Tidak ada file dipilih" readonly>
                                                        </div>
                                                        <div class="mt-2 text-center">
                                                            <img id="preview1" src="#" alt="Preview"
                                                                class="img-thumbnail"
                                                                style="max-width: 150px; max-height: 100px; object-fit: contain; display: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Foto 2</label>
                                                    <div class="custom-file-container">
                                                        <div class="input-group">
                                                            <label class="input-group-text bg-primary text-white"
                                                                for="fileInput2">
                                                                Pilih Gambar
                                                            </label>
                                                            <input type="file" class="form-control" name="foto2"
                                                                id="fileInput2" accept="image/*"
                                                                onchange="previewImage(this, 'preview2')"
                                                                style="display: none;">
                                                            <input type="text" class="form-control" id="fileLabel2"
                                                                placeholder="Tidak ada file dipilih" readonly>
                                                        </div>
                                                        <div class="mt-2 text-center">
                                                            <img id="preview2" src="#" alt="Preview"
                                                                class="img-thumbnail"
                                                                style="max-width: 150px; max-height: 100px; object-fit: contain; display: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Foto 3</label>
                                                    <div class="custom-file-container">
                                                        <div class="input-group">
                                                            <label class="input-group-text bg-primary text-white"
                                                                for="fileInput3">
                                                                Pilih Gambar
                                                            </label>
                                                            <input type="file" class="form-control" name="foto3"
                                                                id="fileInput3" accept="image/*"
                                                                onchange="previewImage(this, 'preview3')"
                                                                style="display: none;">
                                                            <input type="text" class="form-control" id="fileLabel3"
                                                                placeholder="Tidak ada file dipilih" readonly>
                                                        </div>
                                                        <div class="mt-2 text-center">
                                                            <img id="preview3" src="#" alt="Preview"
                                                                class="img-thumbnail"
                                                                style="max-width: 150px; max-height: 100px; object-fit: contain; display: none;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('obat.index') }}" class="btn btn-secondary me-2">Batal</a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const fileLabel = document.getElementById('fileLabel' + previewId.charAt(previewId.length - 1));

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
                fileLabel.value = input.files[0].name;
            } else {
                preview.src = '#';
                preview.style.display = 'none';
                fileLabel.value = 'Tidak ada file dipilih';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.input-group-text').forEach(label => {
                label.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    this.nextElementSibling.click();
                });
            });
        });
    </script>

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Obat Berhasil Ditambahkan!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                background: '#eafaf1',
                color: '#1e7e34',
                iconColor: '#28a745',
            });
        });
    </script>
@endif
@endpush

@endsection



