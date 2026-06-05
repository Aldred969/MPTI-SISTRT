@extends('layouts.admin')

@section('title','Tambah Warga')

@section('content')

<div class="table-box">

<form action="{{ route('warga.store') }}"
      method="POST">

@csrf

<p>NIK</p>
<input type="text"
       name="nik"
       style="width:100%;padding:10px;margin-bottom:15px;">

<p>Nama</p>
<input type="text"
       name="nama"
       style="width:100%;padding:10px;margin-bottom:15px;">

<p>Email</p>
<input type="email"
       name="email"
       style="width:100%;padding:10px;margin-bottom:15px;">

<p>No HP</p>
<input type="text"
       name="no_hp"
       style="width:100%;padding:10px;margin-bottom:15px;">

<p>Password</p>
<input type="password"
       name="password"
       style="width:100%;padding:10px;margin-bottom:15px;">

<button
    type="submit"
    style="
    background:#2563eb;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:8px;">
    Simpan
</button>

</form>

</div>

@endsection