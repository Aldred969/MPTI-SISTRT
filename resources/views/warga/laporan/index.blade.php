@extends('layouts.warga')

@section('title', 'Pengaduan Warga')
@section('page_title', 'Daftar Pengaduan Saya')

@section('breadcrumbs')
<li class="breadcrumb-item active">Pengaduan Warga</li>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-12 text-right">
        <a href="{{ route('warga.laporan.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus mr-1"></i> Buat Pengaduan Baru
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pengaduan & Laporan Anda</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="laporan-table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th width="150">Tanggal</th>
                            <th width="150">Kategori</th>
                            <th>Judul Pengaduan</th>
                            <th>Isi Laporan</th>
                            <th width="120">Status</th>
                            <th>Tanggapan Pengelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $kategoriMap = [
                                'surat_pengantar' => 'Surat Pengantar',
                                'keamanan' => 'Keamanan',
                                'kebersihan' => 'Kebersihan',
                                'infrastruktur' => 'Infrastruktur',
                                'lainnya' => 'Lainnya',
                            ];
                        @endphp
                        @forelse ($laporans as $index => $laporan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d M Y, H:i') }} WIB</td>
                                <td>
                                    <span class="badge badge-secondary px-2 py-1">
                                        {{ $kategoriMap[$laporan->kategori] ?? ucfirst($laporan->kategori) }}
                                    </span>
                                </td>
                                <td class="font-weight-bold text-dark">{{ $laporan->judul }}</td>
                                <td>{!! nl2br(e(Str::limit($laporan->isi_laporan, 200))) !!}</td>
                                <td>
                                    @if ($laporan->status === 'dikirim')
                                        <span class="badge badge-info px-2 py-2 w-100">
                                            <i class="fas fa-paper-plane mr-1"></i> Dikirim
                                        </span>
                                    @elseif ($laporan->status === 'diproses')
                                        <span class="badge badge-warning px-2 py-2 w-100">
                                            <i class="fas fa-spinner fa-spin mr-1"></i> Diproses
                                        </span>
                                    @elseif ($laporan->status === 'selesai')
                                        <span class="badge badge-success px-2 py-2 w-100">
                                            <i class="fas fa-check-double mr-1"></i> Selesai
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($laporan->tanggapan_admin)
                                        <div class="bg-light p-2 rounded border-left border-success" style="border-left-width: 3px !important;">
                                            <strong>Balasan:</strong><br>
                                            <span class="text-sm">{!! nl2br(e($laporan->tanggapan_admin)) !!}</span>
                                        </div>
                                    @else
                                        <span class="text-muted text-sm italic"><i class="far fa-hourglass mr-1"></i> Menunggu tanggapan...</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-bullhorn fa-2x mb-2 d-block"></i>
                                    Anda belum pernah mengajukan pengaduan/laporan.
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
    $(function () {
        if ($("#laporan-table tbody tr").length > 1 || !$("#laporan-table tbody tr td").hasClass("text-center")) {
            $("#laporan-table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "order": [[0, "asc"]],
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "zeroRecords": "Tidak ditemukan data yang sesuai",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        }
    });
</script>
@endsection
