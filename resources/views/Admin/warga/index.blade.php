@extends('layouts.admin')

@section('title','Data Warga')

@section('content')
@if(session('success'))

<div style="
background:#dcfce7;
color:#166534;
padding:12px;
border-radius:8px;
margin-bottom:20px;">

    {{ session('success') }}

</div>

@endif
<div class="table-box">

    <div style="display:flex;justify-content:space-between;margin-bottom:20px;">

        <h3>Data Warga</h3>

        <a href="{{ route('warga.create') }}"
           style="
           background:#2563eb;
           color:white;
           padding:10px 15px;
           border-radius:8px;
           text-decoration:none;">
            + Tambah Warga
        </a>

    </div>

    <form method="GET">

    <input
        type="text"
        name="keyword"
        placeholder="Cari Nama atau NIK..."
        value="{{ request('keyword') }}"
        style="
        padding:10px;
        width:300px;
        border:1px solid #ddd;
        border-radius:8px;">

    <button
        type="submit"
        style="
        padding:10px 15px;
        background:#2563eb;
        color:white;
        border:none;
        border-radius:8px;">

        Cari

    </button>

</form>

<br>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($warga as $item)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $item->nik }}</td>

            <td>{{ $item->nama }}</td>

            <td>{{ $item->email }}</td>

            <td>{{ $item->no_hp }}</td>

            <td>

                <a href="{{ route('warga.edit',$item->id) }}">
                    Edit
                </a>

                |

                <form
                    action="{{ route('warga.destroy',$item->id) }}"
                    method="POST"
                    style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Yakin ingin menghapus data warga ini?')"type="submit">
                     Hapus
                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="6">
                Belum ada data warga
            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

    <div style="margin-top:20px;">
    {{ $warga->links() }}
</div>

</div>

@endsection