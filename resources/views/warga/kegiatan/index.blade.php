@extends('layouts.warga')

@section('title', 'Kegiatan RT')
@section('page_title', 'Kegiatan & Agenda RT')

@section('breadcrumbs')
<li class="breadcrumb-item active">Kegiatan RT</li>
@endsection

@section('content')
<div class="row">
    @forelse ($kegiatans as $kegiatan)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 card-outline card-success shadow-sm d-flex flex-column justify-content-between">
                <div>
                    @if ($kegiatan->foto)
                        <img src="{{ asset($kegiatan->foto) }}" alt="{{ $kegiatan->judul }}" class="card-img-top" style="height: 200px; object-fit: cover; border-top-left-radius: .25rem; border-top-right-radius: .25rem;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px; border-top-left-radius: .25rem; border-top-right-radius: .25rem;">
                            <div class="text-center text-muted">
                                <i class="fas fa-calendar-alt fa-3x mb-2 text-success" style="opacity: 0.5;"></i>
                                <p class="mb-0 text-sm">Agenda Tanpa Foto</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-success px-2 py-1">
                                <i class="far fa-calendar-alt mr-1"></i>
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y') }}
                            </span>
                        </div>
                        <h5 class="card-title font-weight-bold text-dark mb-2" style="font-size: 1.15rem;">{{ $kegiatan->judul }}</h5>
                        <p class="card-text text-muted text-sm mb-3" style="line-height: 1.5;">
                            {!! nl2br(e($kegiatan->deskripsi)) !!}
                        </p>
                    </div>
                </div>
                
                @if ($kegiatan->lokasi)
                    <div class="card-footer bg-white border-top-0 pt-0 pb-3">
                        <div class="text-muted text-sm">
                            <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                            <strong>Lokasi:</strong> {{ $kegiatan->lokasi }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card p-5 text-center shadow-sm">
                <div class="card-body text-muted">
                    <i class="fas fa-calendar-times fa-4x mb-3 text-success" style="opacity: 0.6;"></i>
                    <h4 class="font-weight-bold">Belum Ada Kegiatan Terdaftar</h4>
                    <p class="mb-0">Saat ini belum ada agenda kegiatan warga yang dijadwalkan oleh pengelola RT.</p>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection
