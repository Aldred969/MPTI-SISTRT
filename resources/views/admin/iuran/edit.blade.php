@extends('layouts.admin')

@section('title', 'Ubah Catatan Iuran')
@section('page_title', 'Ubah Catatan Iuran')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.warga.index') }}">Data Warga</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.iuran.history', $warga->id) }}">Riwayat Iuran</a></li>
    <li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-warning card-outline text-white">
            <div class="card-header text-dark">
                <h3 class="card-title">Form Ubah Iuran Warga: <strong>{{ $warga->nama }}</strong></h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('admin.iuran.update', $iuran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body text-dark">
                    <div class="form-group">
                        <label>Nama Warga</label>
                        <input type="text" class="form-control" value="{{ $warga->nama }} (NIK: {{ $warga->nik }})" disabled>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="bulan">Bulan <span class="text-danger">*</span></label>
                                <select class="form-control @error('bulan') is-invalid @enderror" id="bulan" name="bulan" required>
                                    @foreach ($months as $m)
                                        <option value="{{ $m }}" {{ old('bulan', $iuran->bulan) == $m ? 'selected' : '' }}>
                                            {{ $m }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('bulan')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tahun">Tahun <span class="text-danger">*</span></label>
                                <select class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required>
                                    @foreach ($years as $y)
                                        <option value="{{ $y }}" {{ old('tahun', $iuran->tahun) == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tahun')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal Iuran (Rupiah) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal', intval($iuran->nominal)) }}" min="0" required>
                        @error('nominal')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Status Pembayaran <span class="text-danger">*</span></label>
                        <div class="mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status_belum" name="status" class="custom-control-input" value="belum_bayar" {{ old('status', $iuran->status) === 'belum_bayar' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status_belum">Belum Bayar</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="status_lunas" name="status" class="custom-control-input" value="lunas" {{ old('status', $iuran->status) === 'lunas' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="status_lunas">Lunas (Sudah Bayar)</label>
                            </div>
                        </div>
                        @error('status')
                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" id="tanggal_bayar_group" style="display: none;">
                        <label for="tanggal_bayar">Tanggal Pembayaran <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', $iuran->tanggal_bayar ?? date('Y-m-d')) }}">
                        @error('tanggal_bayar')
                            <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning text-white"><i class="fas fa-save mr-1"></i> Perbarui</button>
                    <a href="{{ route('admin.iuran.history', $warga->id) }}" class="btn btn-secondary"><i class="fas fa-times mr-1"></i> Batal</a>
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
        // Toggle tanggal_bayar visibility based on status
        function toggleTanggalBayar() {
            if ($('#status_lunas').is(':checked')) {
                $('#tanggal_bayar_group').show();
                $('#tanggal_bayar').prop('required', true);
            } else {
                $('#tanggal_bayar_group').hide();
                $('#tanggal_bayar').prop('required', false);
            }
        }

        $('input[name="status"]').change(toggleTanggalBayar);
        toggleTanggalBayar(); // Init state
    });
</script>
@endsection
