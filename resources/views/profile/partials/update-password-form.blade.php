<div class="card card-outline card-{{ $theme }} shadow-sm mb-4">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-key mr-2 text-{{ $theme }}"></i>Ubah Kata Sandi
        </h3>
    </div>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        
        <div class="card-body">
            <p class="text-muted text-sm mb-4">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>

            <div class="form-group">
                <label for="update_password_current_password">Kata Sandi Saat Ini <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" id="update_password_current_password" name="current_password" autocomplete="current-password" required>
                @error('current_password', 'updatePassword')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="update_password_password">Kata Sandi Baru <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" id="update_password_password" name="password" autocomplete="new-password" required>
                @error('password', 'updatePassword')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="update_password_password_confirmation">Konfirmasi Kata Sandi Baru <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password" required>
                @error('password_confirmation', 'updatePassword')
                    <span class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        
        <div class="card-footer text-right">
            <button type="submit" class="btn btn-{{ $theme }}">
                <i class="fas fa-key mr-1"></i> Perbarui Kata Sandi
            </button>
        </div>
    </form>
</div>
