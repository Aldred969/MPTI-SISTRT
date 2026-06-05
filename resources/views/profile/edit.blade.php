@php
    $role = auth()->user()->role;
    $theme = $role === 'admin' ? 'primary' : 'success';
    $avatar = $role === 'admin' ? 'dist/img/admin.jpeg' : 'dist/img/warga.jpg';
    $roleLabel = $role === 'admin' ? 'Administrator' : 'Warga Aktif';
@endphp

@extends($role === 'admin' ? 'layouts.admin' : 'layouts.warga')

@section('title', 'Edit Profil')
@section('page_title', 'Edit Profil Saya')

@section('breadcrumbs')
<li class="breadcrumb-item active">Edit Profil</li>
@endsection

@section('content')

{{-- Success Flash --}}
@if (session('status') === 'profile-updated')
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
        Data profil Anda berhasil diperbarui.
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

@if (session('status') === 'password-updated')
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
        Kata sandi Anda berhasil diperbarui.
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
@endif

<div class="row">

    {{-- Kolom Kiri: Avatar Info --}}
    <div class="col-md-3 mb-4">
        <div class="card card-outline card-{{ $theme }} text-center shadow-sm">
            <div class="card-body pt-4 pb-4">
                <img src="{{ asset($avatar) }}" 
                     class="img-circle elevation-2 mb-3" 
                     alt="Foto Profil"
                     style="width: 100px; height: 100px; object-fit: cover;">
                <h5 class="font-weight-bold mb-1">{{ auth()->user()->nama }}</h5>
                <p class="text-muted text-sm mb-1">
                    <i class="fas fa-id-card mr-1"></i> {{ auth()->user()->nik }}
                </p>
                <p class="text-muted text-sm mb-2">
                    <i class="fas fa-envelope mr-1"></i> {{ auth()->user()->email }}
                </p>
                <span class="badge badge-{{ $theme }} px-3 py-2">
                    <i class="fas fa-user-check mr-1"></i> {{ $roleLabel }}
                </span>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Form-form --}}
    <div class="col-md-9">

        {{-- Form 1: Update Informasi Profil --}}
        @include('profile.partials.update-profile-information-form')

        {{-- Form 2: Update Password --}}
        @include('profile.partials.update-password-form')

        {{-- Form 3: Hapus Akun --}}
        @include('profile.partials.delete-user-form')

    </div>
</div>

@endsection
