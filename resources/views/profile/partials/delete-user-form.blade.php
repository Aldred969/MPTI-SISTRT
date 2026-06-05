<div class="card card-outline card-danger shadow-sm mb-4">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">
            <i class="fas fa-trash-alt mr-2 text-danger"></i>Hapus Akun
        </h3>
    </div>
    <div class="card-body">
        <p class="text-muted text-sm mb-3">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, silakan unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
        <button type="button" class="btn btn-danger font-weight-bold" data-toggle="modal" data-target="#confirmUserDeletionModal">
            <i class="fas fa-exclamation-triangle mr-1"></i> Hapus Akun Saya
        </button>
    </div>
</div>

<!-- Bootstrap Modal for Deletion Confirmation -->
<div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" role="dialog" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold" id="confirmUserDeletionModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus Akun
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                
                <div class="modal-body">
                    <p class="font-weight-bold text-danger">Apakah Anda yakin ingin menghapus akun Anda?</p>
                    <p class="text-muted text-sm mb-3">
                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
                    </p>
                    
                    <div class="form-group mb-0">
                        <label for="password">Kata Sandi Anda <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" id="password" name="password" placeholder="Masukkan kata sandi untuk konfirmasi" required>
                        @error('password', 'userDeletion')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="fas fa-undo mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt mr-1"></i> Hapus Akun Permanen
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->userDeletion->isNotEmpty())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (typeof $ !== 'undefined') {
            $('#confirmUserDeletionModal').modal('show');
        } else {
            var modalEl = document.getElementById('confirmUserDeletionModal');
            if (modalEl) {
                $(modalEl).modal('show');
            }
        }
    });
</script>
@endif
