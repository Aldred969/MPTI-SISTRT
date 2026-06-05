@extends('layouts.warga')

@section('title', 'Riwayat Iuran')
@section('page_title', 'Riwayat Iuran Kas Saya')

@section('breadcrumbs')
<li class="breadcrumb-item active">Riwayat Iuran</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Daftar Pembayaran Iuran Kas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="iuran-table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Tanggal Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($iurans as $index => $iuran)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $iuran->bulan }}</td>
                                <td>{{ $iuran->tahun }}</td>
                                <td class="font-weight-bold">Rp {{ number_format($iuran->nominal, 0, ',', '.') }}</td>
                                <td>
                                    @if ($iuran->status === 'lunas')
                                        <span class="badge badge-success px-2 py-2">
                                            <i class="fas fa-check-circle mr-1"></i> Lunas
                                        </span>
                                    @else
                                        <span class="badge badge-danger px-2 py-2">
                                            <i class="fas fa-exclamation-circle mr-1"></i> Belum Bayar
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($iuran->tanggal_bayar)
                                        {{ \Carbon\Carbon::parse($iuran->tanggal_bayar)->translatedFormat('d F Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-money-bill-wave fa-2x mb-2 d-block"></i>
                                    Belum ada catatan iuran kas untuk Anda.
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
        if ($("#iuran-table tbody tr").length > 1 || !$("#iuran-table tbody tr td").hasClass("text-center")) {
            $("#iuran-table").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
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
