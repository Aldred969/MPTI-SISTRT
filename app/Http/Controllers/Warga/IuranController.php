<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    /**
     * Display a listing of the citizen's own iurans.
     */
    public function index()
    {
        $user = auth()->user();
        
        $iurans = Iuran::where('user_id', $user->id)
            ->orderBy('tahun', 'desc')
            ->orderByRaw("FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember') desc")
            ->get();

        return view('warga.iuran.index', compact('iurans'));
    }
}
