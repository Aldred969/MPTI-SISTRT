@extends('layouts.admin')

@section('title', 'Kegiatan RT')
@section('page_title', 'Kegiatan RT')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Kegiatan RT</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Daftar Kegiatan Perumahan</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.kegiatan.create') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-kegiatan" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kegiatans as $index => $row)
                            <tr>
                                <td class="text-center align-middle">{{ $index + 1 }}</td>
                                <td class="text-center align-middle" style="width: 120px;">
                                    @if ($row->foto)
                                        <img src="{{ asset($row->foto) }}" alt="Foto Kegiatan" class="img-thumbnail" style="max-height: 80px; max-width: 100px; object-fit: cover;">
                                    @else
                                        <span class="text-muted text-sm"><i class="far fa-image fa-2x"></i><br>Tidak ada</span>
                                    @endif
                                </td>
                                <td class="align-middle font-weight-bold">{{ $row->judul }}</td>
                                <td class="text-center align-middle" style="width: 100px;">{{ date('d-m-Y', strtotime($row->tanggal)) }}</td>
                                <td class="align-middle">{{ $row->lokasi ?? '-' }}</td>
                                <td class="align-middle">
                                    <span class="d-inline-block text-truncate" style="max-width: 250px;" title="{{ $row->deskripsi }}">
                                        {{ $row->deskripsi }}
                                    </span>
                                </td>
                                <td class="text-center align-middle" style="width: 110px;">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.kegiatan.edit', $row->id) }}" class="btn btn-warning text-white" title="Ubah Kegiatan">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-delete-kegiatan" data-id="{{ $row->id }}" data-judul="{{ $row->judul }}" data-toggle="modal" data-target="#deleteKegiatanModal" title="Hapus Kegiatan">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada agenda kegiatan yang direncanakan.</td>
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
<div class="modal fade" id="deleteKegiatanModal" tabindex="-1" role="dialog" aria-labelledby="deleteKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteKegiatanModalLabel">Hapus Kegiatan RT</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete-kegiatan-form" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus kegiatan <strong id="delete-kegiatan-judul"></strong>?</p>
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
        $("#table-kegiatan").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false
        });

        // Handle delete click
        $('.btn-delete-kegiatan').click(function() {
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            $('#delete-kegiatan-judul').text(judul);
            
            // Set dynamic action url
            var actionUrl = "{{ route('admin.kegiatan.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $('#delete-kegiatan-form').attr('action', actionUrl);
        });
    });
</script>
@endsection
