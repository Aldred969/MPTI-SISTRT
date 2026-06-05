<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Iuran;
use App\Models\Laporan;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Enforce role-based dashboard rendering
        if ($user->role === 'admin') {
            // Count metrics for stats cards
            $totalWarga = User::where('role', 'warga')->count();
            $totalIuran = Iuran::count();
            $totalLaporan = Laporan::count();
            $totalKegiatan = Kegiatan::count();

            // Get latest registered citizens
            $warga = User::where('role', 'warga')
                ->latest()
                ->take(10)
                ->get();

            return view('admin.dashboard', compact(
                'totalWarga',
                'totalIuran',
                'totalLaporan',
                'totalKegiatan',
                'warga'
            ));
        }

        // Warga role dashboard stats
        $totalBayar = Iuran::where('user_id', $user->id)
            ->where('status', 'lunas')
            ->sum('nominal');

        $totalBelumBayar = Iuran::where('user_id', $user->id)
            ->where('status', 'belum_bayar')
            ->sum('nominal');

        $totalLaporan = Laporan::where('user_id', $user->id)->count();

        $totalPengumuman = Pengumuman::where('aktif', true)->count();

        // Get recent activities (kegiatan)
        $kegiatan = Kegiatan::latest()->take(5)->get();

        // Get active announcements (pengumuman)
        $pengumuman = Pengumuman::where('aktif', true)
            ->latest()
            ->take(5)
            ->get();

        return view('warga.dashboard', compact(
            'totalBayar',
            'totalBelumBayar',
            'totalLaporan',
            'totalPengumuman',
            'kegiatan',
            'pengumuman'
        ));
    }
}