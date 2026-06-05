@extends('layouts.admin')

@section('title','Edit Warga')

@section('content')

<div class="table-box">

<form
    action="{{ route('warga.update',$warga->id) }}"
    method="POST">

@csrf
@method('PUT')

<p>NIK</p>
<input type="text"
       name="nik"
       value="{{ $warga->nik }}"
       style="width:100%;padding:10px;margin-bottom:15px;">

<p>Nama</p>
<input type="text"
       name="nama"
       value="{{ $warga->nama }}"
       style="width:100%;padding:10px;margin-bottom:15px;">

<p>Email</p>
<input type="email"
       name="email"
       value="{{ $warga->email }}"
       style="width:100%;padding:10px;margin-bottom:15px;">

<p>No HP</p>
<input type="text"
       name="no_hp"
       value="{{ $warga->no_hp }}"
       style="width:100%;padding:10px;margin-bottom:15px;">

<button
    type="submit"
    style="
    background:#2563eb;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:8px;">

    Update Data

</button>

</form>

</div>

@endsection