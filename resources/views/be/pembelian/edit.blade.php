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
                                    <h4 class="mb-0">Edit Pembelian</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="no_nota">Nomor Nota</label>
                                                    <input type="text" class="form-control @error('no_nota') is-invalid @enderror"
                                                        id="no_nota" name="no_nota" value="{{ old('no_nota', $pembelian->no_nota) }}" required>
                                                    @error('no_nota')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="tgl_pembelian">Tanggal Pembelian</label>
                                                    <input type="date" class="form-control @error('tgl_pembelian') is-invalid @enderror"
                                                        id="tgl_pembelian" name="tgl_pembelian" value="{{ old('tgl_pembelian', $pembelian->tgl_pembelian) }}" required>
                                                    @error('tgl_pembelian')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="distributor_id">Distributor</label>
                                                    <select class="form-control @error('distributor_id') is-invalid @enderror"
                                                        id="distributor_id" name="distributor_id" required>
                                                        <option value="">Pilih Distributor</option>
                                                        @foreach($distributors as $distributor)
                                                            <option value="{{ $distributor->id }}" {{ old('distributor_id', $pembelian->distributor_id) == $distributor->id ? 'selected' : '' }}>
                                                                {{ $distributor->nama_distributor }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('distributor_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border p-3 mb-3">
                                            <h5>Detail Obat</h5>
                                            <div id="obat-container">
                                                @foreach($pembelian->details as $detail)
                                                <div class="row obat-item mb-3">
                                                    <input type="hidden" name="detail_id[]" value="{{ $detail->id }}">
                                                    <div class="col-md-4">
                                                        <select class="form-control obat-select" name="obat_id[]" required>
                                                            <option value="">Pilih Obat</option>
                                                            @foreach($obat as $item)
                                                                <option value="{{ $item->id }}" {{ $detail->obat_id == $item->id ? 'selected' : '' }}>
                                                                    {{ $item->nama_obat }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control" name="jumlah[]" placeholder="Jumlah" value="{{ $detail->jumlah_beli }}" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="number" class="form-control" name="harga_beli[]" placeholder="Harga Beli" value="{{ $detail->harga_beli }}" required>
                                                    </div>
                                                    {{-- <div class="col-md-2">
                                                        <button type="button" class="btn btn-danger remove-obat">Hapus</button>
                                                    </div> --}}
                                                </div>
                                                @endforeach
                                            </div>
                                            {{-- <button type="button" class="btn btn-success" id="add-obat">Tambah Obat</button> --}}
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Pembelian</button>
                                            <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">Kembali</a>
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
        // Hilangkan script add-obat dan remove-obat
    </script>
    @endpush
@endsection
