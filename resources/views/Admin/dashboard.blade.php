@extends('layouts.admin')

@section('title','Dashboard')

@section('content')

<div class="card-container">

    <div class="card">
        <h4>Total Warga</h4>
        <h2>{{ $totalWarga }}</h2>
    </div>

    <div class="card">
        <h4>Total Iuran</h4>
        <h2> Rp {{ number_format($totalIuran,0,',','.') }} </h2>
    </div>

    <div class="card">
        <h4>Laporan Masuk</h4>
        <h2>{{ $totalLaporan }}</h2>
    </div>

    <div class="card">
        <h4>Kegiatan RT</h4>
        <h2>{{ $totalKegiatan }}</h2>
    </div>

</div>

<div class="table-box">

    <h3>Laporan Terbaru</h3>

    <table>

        <thead>
            <tr>
                <th>Warga</th>
                <th>Judul</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($laporanTerbaru as $laporan)
            <tr>
                <td> {{ $laporan->user->nama ?? '-' }} </td>
                <td> {{ $laporan->judul }} </td>
                
<td>
    @if($laporan->status == 'selesai')
    <span class="badge success">
    Selesai
    </span>
    @elseif($laporan->status == 'diproses')
    <span class="badge warning">
    Diproses
    </span>
    @else
    <span class="badge danger">
    Dikirim
    </span>
    @endif
</td>

</tr>
    @empty
    <tr>
        <td colspan="3">
            Belum ada laporan
        </td>
    </tr>
    @endforelse
</tbody>

    </table>

</div>

@endsection