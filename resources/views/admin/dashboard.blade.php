@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalWarga }}</h3>
                <p>Total Warga</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('admin.warga.index') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalIuran }}</h3>
                <p>Transaksi Iuran</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-check-alt"></i>
            </div>
            <a href="{{ route('admin.iuran.report') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3 class="text-white">{{ $totalLaporan }}</h3>
                <p class="text-white">Aduan Warga</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="small-box-footer text-white">Selengkapnya <i class="fas fa-arrow-circle-right text-white"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalKegiatan }}</h3>
                <p>Kegiatan RT</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="{{ route('admin.kegiatan.index') }}" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <!-- Left col -->
    <section class="col-lg-12 connectedSortable">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-plus mr-1"></i>
                    Warga Baru Mendaftar (Terbaru)
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.warga.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua Warga
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0 table-hover table-striped">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Warga</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Tanggal Registrasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($warga as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $item->nik }}</td>
                                    <td class="font-weight-bold">{{ $item->nama }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-center">{{ $item->no_hp ?? '-' }}</td>
                                    <td class="text-center">{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada data warga terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
</div>
@endsection