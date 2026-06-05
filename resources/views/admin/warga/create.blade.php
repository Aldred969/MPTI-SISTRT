@extends('layouts.admin')

@section('title', 'Tambah Warga')
@section('page_title', 'Tambah Warga')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.warga.index') }}">Data Warga</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Form Warga Baru</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.warga.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nik">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" placeholder="Contoh: 3201xxxxxxxxxxxx" maxlength="16" required autocomplete="off">
                        @error('nik')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Harus bernilai tepat 16 digit angka.</small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama warga lengkap" required autocomplete="off">
                        @error('nama')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="warga@example.com" required autocomplete="off">
                        @error('email')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Email ini akan digunakan oleh warga untuk masuk (log in) ke sistem.</small>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">Nomor Handphone</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789" autocomplete="off">
                        @error('no_hp')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Kata Sandi Akun <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btn-toggle-pwd">
                                    <i class="fas fa-eye" id="pwd-icon"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Simpan</button>
                    <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary"><i class="fas fa-times mr-1"></i> Batal</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('#btn-toggle-pwd').click(function() {
            var pwdField = $('#password');
            var icon = $('#pwd-icon');
            if (pwdField.attr('type') === 'password') {
                pwdField.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                pwdField.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endsection
