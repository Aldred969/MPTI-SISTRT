@extends('layouts.admin')

@section('title', 'Riwayat Iuran Warga')
@section('page_title', 'Riwayat Iuran')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.warga.index') }}">Data Warga</a></li>
    <li class="breadcrumb-item active">Riwayat Iuran</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Riwayat Iuran Warga: <strong>{{ $warga->nama }}</strong> (NIK: {{ $warga->nik }})</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.iuran.create', ['warga_id' => $warga->id]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus mr-1"></i> Tambah Tagihan/Bayar
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="table-iuran-warga" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Periode (Bulan - Tahun)</th>
                            <th>Nominal</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($iurans as $index => $row)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row->bulan }} {{ $row->tahun }}</td>
                                <td>Rp {{ number_format($row->nominal, 2, ',', '.') }}</td>
                                <td>
                                    @if ($row->status === 'lunas')
                                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Lunas</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1"><i class="fas fa-times-circle mr-1"></i> Belum Bayar</span>
                                    @endif
                                </td>
                                <td>{{ $row->tanggal_bayar ? date('d-m-Y', strtotime($row->tanggal_bayar)) : '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        @if ($row->status === 'belum_bayar')
                                            <form action="{{ route('admin.iuran.pay', $row->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success" title="Tandai Sudah Bayar (Lunas)">
                                                    <i class="fas fa-money-bill-wave"></i> Bayar
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.iuran.edit', $row->id) }}" class="btn btn-warning text-white" title="Ubah Catatan">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-delete-iuran" data-id="{{ $row->id }}" data-periode="{{ $row->bulan }} {{ $row->tahun }}" data-toggle="modal" data-target="#deleteIuranModal" title="Hapus Catatan">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada catatan iuran untuk warga ini.</td>
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
<div class="modal fade" id="deleteIuranModal" tabindex="-1" role="dialog" aria-labelledby="deleteIuranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteIuranModalLabel">Hapus Catatan Iuran</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="delete-iuran-form" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus catatan iuran periode <strong id="delete-iuran-periode"></strong>?</p>
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
        $("#table-iuran-warga").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false
        });

        // Handle delete click
        $('.btn-delete-iuran').click(function() {
            var id = $(this).data('id');
            var periode = $(this).data('periode');
            $('#delete-iuran-periode').text(periode);
            
            // Set dynamic action url
            var actionUrl = "{{ route('admin.iuran.destroy', ':id') }}";
            actionUrl = actionUrl.replace(':id', id);
            $('#delete-iuran-form').attr('action', actionUrl);
        });
    });
</script>
@endsection
