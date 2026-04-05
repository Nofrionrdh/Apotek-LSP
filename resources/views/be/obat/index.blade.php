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
                                    <h4 class="mb-0">Daftar Obat</h4>
                                    <a href="{{ route('obat.create') }}" class="btn btn-primary">
                                    Tambah Obat
                                    </a>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('obat.index') }}" method="GET" class="mb-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="search" 
                                                           placeholder="Cari nama obat..." 
                                                           value="{{ request('search') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <select class="form-control" name="jenis">
                                                        <option value="">Semua Jenis Obat</option>
                                                        @foreach($jenis_obat as $jenis)
                                                            <option value="{{ $jenis->id }}" 
                                                                    {{ request('jenis') == $jenis->id ? 'selected' : '' }}>
                                                                {{ $jenis->jenis }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary w-100" type="submit">
                                                    <i class="fas fa-search"></i> Cari
                                                </button>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="{{ route('obat.index') }}" class="btn btn-secondary w-100">
                                                    <i class="fas fa-sync"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-striped font-roboto">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="text-center align-middle fw-bold" width="5%">No</th>
                                                    <th class="align-middle fw-bold" width="20%">Nama Obat</th>
                                                    <th class="align-middle fw-bold" width="15%">Jenis</th>
                                                    <th class="align-middle fw-bold" width="15%">Deskripsi</th>
                                                    <th class="align-middle fw-bold" width="12%">Harga</th>
                                                    <th class="align-middle fw-bold" width="8%">Stok</th>
                                                    <th class="align-middle text-center fw-bold" width="15%">Gambar</th>
                                                    <th class="text-center align-middle fw-bold" width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="font-medium">
                                                @foreach ($obats as $item)
                                                    <tr class="align-middle">
                                                        <td class="text-center">{{ ($obats->currentPage() - 1) * $obats->perPage() + $loop->iteration }}</td>
                                                        <td>{{ $item->nama_obat }}</td>
                                                        <td>{{ optional($item->jenis_obat)->jenis }}</td>
                                                        <td class="font-small">{{ Str::limit($item->deskripsi_obat, 50) }}
                                                        </td>
                                                        <td>
                                                            Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                                                        </td>
                                                        <td>{{ $item->stok }}</td>
                                                        <td class="text-center">
                                                            <img src="{{ asset('storage/' . $item->foto1) }}"
                                                                alt="Foto Obat" class="rounded" width="60"
                                                                height="60" style="object-fit: cover;">
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                @if(auth()->check() && auth()->user()->jabatan == 'kasir')
                                                                    <button type="button" class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#marginModal-{{ $item->id }}">
                                                                        <i class="fa-solid fa-percent"></i>
                                                                    </button>
                                                                @endif
                                                                <a href="{{ route('obat.edit', $item->id) }}"
                                                                    class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>
                                                                <form action="{{ route('obat.destroy', $item->id) }}" method="POST" class="d-inline form-delete">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-sm btn-danger btn-delete">
                                                                        <i class="fa-solid fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            @if(auth()->check() && auth()->user()->jabatan == 'kasir')
                                                            <!-- Modal Margin -->
                                                            <div class="modal fade" id="marginModal-{{ $item->id }}" tabindex="-1" aria-labelledby="marginModalLabel-{{ $item->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form class="modal-content" method="POST" action="{{ route('obat.update', $item->id) }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="marginModalLabel-{{ $item->id }}">Atur Margin & Harga</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Harga Beli</label>
                                                                                <input type="number" name="harga_beli" class="form-control harga-beli-input" value="{{ $item->harga_beli ?? 0 }}" min="0" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Persen Keuntungan (%)</label>
                                                                                <input type="number" name="persen_untung" class="form-control persen-untung-input" value="{{ $item->persen_untung ?? 0 }}" min="0" max="100" required>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label class="form-label">Harga Jual</label>
                                                                                <input type="number" class="form-control harga-jual-output" value="{{ $item->harga_jual ?? 0 }}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                    {{-- <tr>
                                                        <td colspan="8" class="text-center text-muted">Data obat tidak ditemukan.</td>
                                                    </tr>
                                                @endforelse --}}
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Pagination --}}
                                    @if ($obats->hasPages())
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                                            <nav>
                                                <ul class="pagination pagination-sm mb-0">
                                                    {{-- Previous Page Link --}}
                                                    @if ($obats->onFirstPage())
                                                        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                                                    @else
                                                        <li class="page-item"><a class="page-link" href="{{ $obats->previousPageUrl() }}">&laquo;</a></li>
                                                    @endif

                                                    {{-- Pagination Elements --}}
                                                    @foreach ($obats->getUrlRange(1, $obats->lastPage()) as $page => $url)
                                                        @if ($page == $obats->currentPage())
                                                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                                        @else
                                                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                                        @endif
                                                    @endforeach

                                                    {{-- Next Page Link --}}
                                                    @if ($obats->hasMorePages())
                                                        <li class="page-item"><a class="page-link" href="{{ $obats->nextPageUrl() }}">&raquo;</a></li>
                                                    @else
                                                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                                                    @endif
                                                </ul>
                                            </nav>
                                            <div class="text-muted small ms-1 mb-2 mb-md-0">
                                                Menampilkan {{ $obats->firstItem() }} - {{ $obats->lastItem() }} dari {{ $obats->total() }} data
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
        // SweetAlert hapus
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Margin Modal: Kalkulasi harga jual otomatis
        document.querySelectorAll('.modal').forEach(function(modal) {
            modal.addEventListener('shown.bs.modal', function () {
                const hargaBeliInput = modal.querySelector('.harga-beli-input');
                const persenUntungInput = modal.querySelector('.persen-untung-input');
                const hargaJualOutput = modal.querySelector('.harga-jual-output');

                function updateHargaJual() {
                    let hargaBeli = parseFloat(hargaBeliInput.value) || 0;
                    let persenUntung = parseFloat(persenUntungInput.value) || 0;
                    let hargaJual = hargaBeli + (hargaBeli * persenUntung / 100);
                    hargaJualOutput.value = Math.round(hargaJual);
                }

                hargaBeliInput.addEventListener('input', updateHargaJual);
                persenUntungInput.addEventListener('input', updateHargaJual);

                // Trigger kalkulasi awal
                updateHargaJual();
            });
        });
    });
</script>
@endpush

@endsection
