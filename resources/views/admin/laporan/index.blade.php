@extends('layouts.admin')

@section('title', 'Pengaduan Warga')
@section('page_title', 'Pengaduan Warga')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Pengaduan Warga</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Pengaduan & Laporan Warga</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-laporan" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Warga</th>
                            <th>Kategori</th>
                            <th>Judul Laporan</th>
                            <th>Status</th>
                            <th>Tanggal Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporans as $index => $row)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $row->user->nama ?? 'Warga Terhapus' }}</td>
                                <td class="text-center">
                                    @switch($row->kategori)
                                        @case('surat_pengantar')
                                            <span class="badge bg-secondary px-2 py-1">Surat Pengantar</span>
                                            @break
                                        @case('keamanan')
                                            <span class="badge bg-danger px-2 py-1">Keamanan</span>
                                            @break
                                        @case('kebersihan')
                                            <span class="badge bg-warning px-2 py-1">Kebersihan</span>
                                            @break
                                        @case('infrastruktur')
                                            <span class="badge bg-info px-2 py-1">Infrastruktur</span>
                                            @break
                                        @default
                                            <span class="badge bg-light border px-2 py-1">Lainnya</span>
                                    @endswitch
                                </td>
                                <td>{{ $row->judul }}</td>
                                <td class="text-center">
                                    @if ($row->status === 'selesai')
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Selesai</span>
                                    @elseif ($row->status === 'diproses')
                                        <span class="badge badge-warning text-white px-2 py-1"><i class="fas fa-spinner fa-spin mr-1"></i> Diproses</span>
                                    @else
                                        <span class="badge badge-info px-2 py-1"><i class="fas fa-paper-plane mr-1"></i> Dikirim</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ date('d-m-Y H:i', strtotime($row->created_at)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.laporan.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-reply mr-1"></i> Tanggapi
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada pengaduan yang dikirim oleh warga.</td>
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
        $("#table-laporan").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "order": [[5, "desc"]] // Sort by date descending by default
        });
    });
</script>
@endsection
