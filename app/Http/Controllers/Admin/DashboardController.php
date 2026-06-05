<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Iuran;
use App\Models\Laporan;
use App\Models\Kegiatan;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarga = User::where('role', 'warga')->count();

        $totalIuran = Iuran::sum('nominal');

        $totalLaporan = Laporan::count();

        $totalKegiatan = Kegiatan::count();

        $laporanTerbaru = Laporan::latest()
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact(
            'totalWarga',
            'totalIuran',
            'totalLaporan',
            'totalKegiatan',
            'laporanTerbaru'
        ));
    }
}