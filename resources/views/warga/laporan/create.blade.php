@extends('layouts.warga')

@section('title', 'Buat Pengaduan')
@section('page_title', 'Buat Pengaduan Baru')

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('warga.laporan.index') }}">Pengaduan Warga</a></li>
<li class="breadcrumb-item active">Buat Pengaduan</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-outline card-success shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Formulir Pengaduan / Layanan Warga</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('warga.laporan.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="kategori">Kategori Pengaduan <span class="text-danger">*</span></label>
                        <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <option value="surat_pengantar" {{ old('kategori') == 'surat_pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                            <option value="keamanan" {{ old('kategori') == 'keamanan' ? 'selected' : '' }}>Keamanan</option>
                            <option value="kebersihan" {{ old('kategori') == 'kebersihan' ? 'selected' : '' }}>Kebersihan</option>
                            <option value="infrastruktur" {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur / Sarana</option>
                            <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('kategori')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul Laporan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Pengajuan Surat Pengantar Domisili / Kerusakan Lampu Jalan" required>
                        @error('judul')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="isi_laporan">Rincian Laporan / Pengaduan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('isi_laporan') is-invalid @enderror" id="isi_laporan" name="isi_laporan" rows="6" placeholder="Tuliskan kronologi, lokasi detail, atau permohonan Anda dengan jelas..." required>{{ old('isi_laporan') }}</textarea>
                        @error('isi_laporan')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer text-right">
                    <a href="{{ route('warga.laporan.index') }}" class="btn btn-default mr-2">
                        <i class="fas fa-undo mr-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-paper-plane mr-1"></i> Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection
