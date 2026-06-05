<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of complaints.
     */
    public function index()
    {
        $laporans = Laporan::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    /**
     * Show the form for editing the complaint response.
     */
    public function edit(string $id)
    {
        $laporan = Laporan::with('user')->findOrFail($id);
        return view('admin.laporan.edit', compact('laporan'));
    }

    /**
     * Update the complaint status and feedback.
     */
    public function update(Request $request, string $id)
    {
        $laporan = Laporan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:dikirim,diproses,selesai',
            'tanggapan_admin' => 'nullable|string|max:5000',
        ], [
            'status.required' => 'Status laporan wajib dipilih.',
            'status.in' => 'Status laporan tidak valid.',
        ]);

        $laporan->update([
            'status' => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin,
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Tanggapan dan status laporan berhasil diperbarui.');
    }
}
