<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of complaints submitted by the authenticated citizen.
     */
    public function index()
    {
        $laporans = Laporan::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('warga.laporan.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new complaint.
     */
    public function create()
    {
        return view('warga.laporan.create');
    }

    /**
     * Store a newly created complaint in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:surat_pengantar,keamanan,kebersihan,infrastruktur,lainnya',
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string|max:5000',
        ], [
            'kategori.required' => 'Kategori pengaduan wajib dipilih.',
            'kategori.in' => 'Kategori pengaduan tidak valid.',
            'judul.required' => 'Judul pengaduan wajib diisi.',
            'judul.max' => 'Judul pengaduan maksimal 255 karakter.',
            'isi_laporan.required' => 'Isi laporan pengaduan wajib diisi.',
            'isi_laporan.max' => 'Isi laporan pengaduan maksimal 5000 karakter.',
        ]);

        Laporan::create([
            'user_id' => auth()->id(),
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'status' => 'dikirim',
        ]);

        return redirect()->route('warga.laporan.index')->with('success', 'Pengaduan Anda berhasil dikirim dan akan segera diproses oleh pengelola.');
    }
}
