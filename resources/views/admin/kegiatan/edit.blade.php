@extends('layouts.admin')

@section('title', 'Ubah Kegiatan')
@section('page_title', 'Ubah Kegiatan')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.kegiatan.index') }}">Kegiatan RT</a></li>
    <li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-warning card-outline text-white">
            <div class="card-header text-dark">
                <h3 class="card-title">Form Ubah Agenda Kegiatan</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body text-dark">
                    <div class="form-group">
                        <label for="judul">Judul Kegiatan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $kegiatan->judul) }}" placeholder="Contoh: Kerja Bakti Bulanan" required autocomplete="off">
                        @error('judul')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal Kegiatan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}" required>
                                @error('tanggal')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lokasi">Lokasi / Tempat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $kegiatan->lokasi) }}" placeholder="Contoh: Lapangan Serbaguna RT" required autocomplete="off">
                                @error('lokasi')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Tuliskan detail agenda kegiatan..." required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Kegiatan / Brosur</label>
                        @if ($kegiatan->foto)
                            <div class="mb-2">
                                <label class="d-block text-sm">Foto Saat Ini:</label>
                                <img src="{{ asset($kegiatan->foto) }}" alt="Foto Kegiatan" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">Pilih berkas gambar baru untuk mengganti...</label>
                        </div>
                        @error('foto')
                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        <small class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG, GIF. Ukuran maksimum 2MB. Kosongkan jika tidak ingin mengganti foto.</small>
                    </div>
                    
                    <div class="form-group mt-3" id="preview-group" style="display: none;">
                        <label>Pratinjau Gambar Baru:</label>
                        <div>
                            <img id="img-preview" src="#" alt="Pratinjau Foto" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning text-white"><i class="fas fa-save mr-1"></i> Perbarui</button>
                    <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary"><i class="fas fa-times mr-1"></i> Batal</a>
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
        // Update input label and preview image
        $('#foto').change(function() {
            var input = this;
            var fileName = input.files[0].name;
            $(input).next('.custom-file-label').addClass("selected").html(fileName);

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img-preview').attr('src', e.target.result);
                    $('#preview-group').show();
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@endsection
