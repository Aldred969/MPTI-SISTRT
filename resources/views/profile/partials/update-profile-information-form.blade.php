<div class="card card-outline card-{{ $theme }} shadow-sm mb-4">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-user-edit mr-2 text-{{ $theme }}"></i>Informasi Profil
        </h3>
    </div>
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')
        
        <div class="card-body">
            <p class="text-muted text-sm mb-4">Perbarui informasi profil dan alamat email akun Anda.</p>

            <div class="form-group">
                <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                <input type="text" class="form-control" id="nik" value="{{ $user->nik }}" readonly disabled>
                <small class="form-text text-muted">NIK tidak dapat diubah secara mandiri. Hubungi pengurus RT jika ada kesalahan data NIK Anda.</small>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required autocomplete="name">
                @error('nama')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Alamat Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                @error('email')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_hp">Nomor Handphone / WA</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Contoh: 08123456789" autocomplete="tel">
                @error('no_hp')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-{{ $theme }}">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
