@extends('layouts.admin')

@section('title', 'Jumlah Kas Bulanan')
@section('page_title', 'Jumlah Kas')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Jumlah Kas</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Rekapitulasi Iuran Kas Bulanan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Filter Form -->
                <form action="{{ route('admin.iuran.total') }}" method="GET" class="mb-4">
                    <div class="form-row align-items-center">
                        <div class="col-md-3 my-1">
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
                                <i class="fas fa-search mr-1"></i> Filter
                            </button>
                        </div>
                    </div>
                </form>

                <div class="alert alert-info py-2 mb-4">
                    <i class="fas fa-calendar-alt mr-1"></i> Menampilkan total rekap kas iuran warga untuk tahun kalender <strong>{{ $selectedTahun }}</strong>.
                </div>

                <table id="table-totals" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Bulan</th>
                            <th>Kas Terbayar (Lunas)</th>
                            <th>Belum Terbayar</th>
                            <th>Total Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportData as $row)
                            <tr class="text-center">
                                <td>{{ $row['bulan'] }}</td>
                                <td class="text-success font-weight-bold">Rp {{ number_format($row['paid'], 2, ',', '.') }}</td>
                                <td class="text-danger">Rp {{ number_format($row['unpaid'], 2, ',', '.') }}</td>
                                <td class="font-weight-bold">Rp {{ number_format($row['total'], 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-center font-weight-bold bg-light">
                            <td>Grand Total</td>
                            <td class="text-success text-lg">Rp {{ number_format($grandTotalPaid, 2, ',', '.') }}</td>
                            <td class="text-danger text-lg">Rp {{ number_format($grandTotalUnpaid, 2, ',', '.') }}</td>
                            <td class="text-primary text-lg">Rp {{ number_format($grandTotalPaid + $grandTotalUnpaid, 2, ',', '.') }}</td>
                        </tr>
                    </tfoot>
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
        $("#table-totals").DataTable({
            "responsive": true,
            "lengthChange": false,
            "paging": false,
            "ordering": false,
            "info": false,
            "searching": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#table-totals_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
