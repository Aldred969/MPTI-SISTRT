@extends('layouts.admin')

@section('title', 'Data Warga')
@section('page_title', 'Data Warga')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Data Warga</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Warga Perumahan</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.warga.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-user-plus mr-1"></i> Tambah Warga
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-warga" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama Warga</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($warga as $index => $row)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $row->nik }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->email }}</td>
                                <td class="text-center">{{ $row->no_hp ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.warga.edit', $row->id) }}" class="btn btn-warning text-white" title="Ubah Profil Warga">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-delete-warga" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}" data-toggle="modal" data-target="#deleteModal" title="Hapus Warga">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <a href="{{ route('admin.iuran.history', $row->id) }}" class="btn btn-primary" title="Riwayat Iuran">
                                            <i class="fas fa-file-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.iuran.create', ['warga_id' => $row->id]) }}" class="btn btn-success" title="Tambah Iuran">
                                            <i class="fas fa-plus-circle"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada data warga terdaftar.</td>
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

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteModalLabel">Hapus Data Warga</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete-form" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus data warga <strong id="delete-warga-nama"></strong>?</p>
                    <p class="text-sm text-danger mb-0"><i class="fas fa-exclamation-triangle"></i> Seluruh data iuran dan pengaduan milik warga ini juga akan terhapus secara permanen.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Init DataTable
        $("#table-warga").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table-warga_wrapper .col-md-6:eq(0)');

        // Handle delete click
        $('.btn-delete-warga').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            $('#delete-warga-nama').text(nama);
            
            // Set dynamic action url
            var actionUrl = "{{ route('admin.warga.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $('#delete-form').attr('action', actionUrl);
        });
    });
</script>
@endsection
