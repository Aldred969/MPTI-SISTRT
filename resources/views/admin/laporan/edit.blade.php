@extends('layouts.admin')

@section('title', 'Tanggapi Pengaduan')
@section('page_title', 'Tanggapi Pengaduan')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.laporan.index') }}">Pengaduan Warga</a></li>
    <li class="breadcrumb-item active">Tanggapi</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Complaint Detail Card -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Rincian Pengaduan</h3>
                <span class="float-right text-muted text-sm">Masuk pada: {{ date('d-m-Y H:i', strtotime($laporan->created_at)) }}</span>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Pengirim:</div>
                    <div class="col-sm-9">{{ $laporan->user->nama ?? 'Warga Terhapus' }} (NIK: {{ $laporan->user->nik ?? '-' }})</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Kategori:</div>
                    <div class="col-sm-9 text-capitalize">{{ str_replace('_', ' ', $laporan->kategori) }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-3 font-weight-bold">Judul Laporan:</div>
                    <div class="col-sm-9 font-weight-bold">{{ $laporan->judul }}</div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="col-sm-12 font-weight-bold mb-2">Isi Pengaduan / Laporan:</div>
                    <div class="col-sm-12 bg-light p-3 border rounded" style="white-space: pre-wrap; font-size: 15px;">{{ $laporan->isi_laporan }}</div>
                </div>
            </div>
        </div>

        <!-- Tanggapan Form Card -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Tanggapan Administrator</h3>
            </div>
            <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="status">Status Laporan <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="dikirim" {{ old('status', $laporan->status) === 'dikirim' ? 'selected' : '' }}>Dikirim (Menunggu Tindakan)</option>
                            <option value="diproses" {{ old('status', $laporan->status) === 'diproses' ? 'selected' : '' }}>Diproses (Sedang Ditindaklanjuti)</option>
                            <option value="selesai" {{ old('status', $laporan->status) === 'selesai' ? 'selected' : '' }}>Selesai (Sudah Ditangani)</option>
                        </select>
                        @error('status')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggapan_admin">Isi Tanggapan / Tindakan Admin</label>
                        <textarea class="form-control @error('tanggapan_admin') is-invalid @enderror" id="tanggapan_admin" name="tanggapan_admin" rows="6" placeholder="Masukkan tanggapan atau status tindakan yang sedang/telah dilakukan...">{{ old('tanggapan_admin', $laporan->tanggapan_admin) }}</textarea>
                        @error('tanggapan_admin')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Tanggapan ini akan dapat langsung dibaca oleh warga pelapor pada akun mereka.</small>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane mr-1"></i> Simpan Tanggapan</button>
                    <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary"><i class="fas fa-times mr-1"></i> Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
