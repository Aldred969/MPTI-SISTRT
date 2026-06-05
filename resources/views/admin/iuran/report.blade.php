@extends('layouts.admin')

@section('title', 'Laporan Kas (Belum Bayar)')
@section('page_title', 'Laporan Kas')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Laporan Kas</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Warga yang Belum Membayar Iuran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Filter Form -->
                <form action="{{ route('admin.iuran.report') }}" method="GET" class="mb-4">
                    <div class="form-row align-items-center">
                        <div class="col-md-3 my-1">
                            <label class="sr-only" for="bulan">Bulan</label>
                            <select class="form-control" id="bulan" name="bulan">
                                @foreach ($months as $m)
                                    <option value="{{ $m }}" {{ $selectedBulan == $m ? 'selected' : '' }}>
                                        {{ $m }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 my-1">
                            <label class="sr-only" for="tahun">Tahun</label>
                            <select class="form-control" id="tahun" name="tahun">
                                @foreach ($years as $y)
                                    <option value="{{ $y }}" {{ $selectedTahun == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 my-1">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search mr-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>

                <div class="alert alert-info py-2 mb-4">
                    <i class="fas fa-info-circle mr-1"></i> Menampilkan warga yang belum bayar/belum dibuatkan catatan iurannya untuk periode <strong>{{ $selectedBulan }} {{ $selectedTahun }}</strong>.
                </div>

                <table id="table-unpaid" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Warga</th>
                            <th>Nomor HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($unpaidWarga as $index => $row)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $row->nik }}</td>
                                <td>{{ $row->nama }}</td>
                                <td class="text-center">{{ $row->no_hp ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.iuran.create', ['warga_id' => $row->id]) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-plus-circle mr-1"></i> Catat Pembayaran
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-success font-weight-bold">
                                    <i class="fas fa-check-circle mr-1"></i> Luar biasa! Semua warga sudah melunasi iuran untuk periode ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#table-unpaid").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table-unpaid_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
