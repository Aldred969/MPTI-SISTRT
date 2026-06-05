@extends('layouts.warga')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Warga')

@section('content')
<div class="row">
    <!-- Small Boxes -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp {{ number_format($totalBayar, 0, ',', '.') }}</h3>
                <p>Iuran Lunas</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('warga.iuran.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Rp {{ number_format($totalBelumBayar, 0, ',', '.') }}</h3>
                <p>Belum Dibayar</p>
            </div>
            <div class="icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <a href="{{ route('warga.iuran.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalLaporan }}</h3>
                <p>Aduan & Laporan Saya</p>
            </div>
            <div class="icon">
                <i class="fas fa-bullhorn"></i>
            </div>
            <a href="{{ route('warga.laporan.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalPengumuman }}</h3>
                <p>Pengumuman Aktif</p>
            </div>
            <div class="icon">
                <i class="fas fa-bell"></i>
            </div>
            <a href="#pengumuman-section" class="small-box-footer">
                Lihat Pengumuman <i class="fas fa-arrow-circle-down"></i>
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pengumuman Section -->
    <div class="col-md-6" id="pengumuman-section">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bullhorn mr-1"></i>
                    Pengumuman Terbaru
                </h3>
            </div>
            <div class="card-body">
                @if ($pengumuman->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-info-circle fa-2x mb-2"></i>
                        <p class="mb-0">Tidak ada pengumuman aktif saat ini.</p>
                    </div>
                @else
                    <div class="timeline timeline-inverse">
                        @foreach ($pengumuman as $item)
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-envelope bg-primary"></i>
                                <div class="timeline-item">
                                    <span class="time">
                                        <i class="far fa-clock"></i> 
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d M Y') }}
                                    </span>
                                    <h3 class="timeline-header font-weight-bold text-primary">{{ $item->judul }}</h3>
                                    <div class="timeline-body">
                                        {!! nl2br(e($item->isi_pengumuman)) !!}
                                    </div>
                                    @if ($item->tanggal_selesai)
                                        <div class="timeline-footer">
                                            <span class="badge badge-secondary">
                                                Berlaku s/d: {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d M Y') }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div>
                            <i class="far fa-clock bg-gray"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Kegiatan Section -->
    <div class="col-md-6">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    Kegiatan RT Terdekat
                </h3>
                <div class="card-tools">
                    <a href="{{ route('warga.kegiatan.index') }}" class="btn btn-tool btn-sm">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if ($kegiatan->isEmpty())
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-calendar-times fa-2x mb-2"></i>
                        <p class="mb-0">Belum ada agenda kegiatan yang terdaftar.</p>
                    </div>
                @else
                    <div class="list-group">
                        @foreach ($kegiatan as $event)
                            <div class="list-group-item list-group-item-action flex-column align-items-start mb-2 border-left-success" style="border-left: 4px solid #28a745 !important;">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 font-weight-bold">{{ $event->judul }}</h5>
                                    <small class="text-success font-weight-bold">
                                        {{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d M Y') }}
                                    </small>
                                </div>
                                <p class="mb-1 text-sm text-muted">
                                    {{ Str::limit($event->deskripsi, 120, '...') }}
                                </p>
                                @if ($event->lokasi)
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $event->lokasi }}
                                    </small>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
