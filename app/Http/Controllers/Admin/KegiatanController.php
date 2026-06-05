<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class KegiatanController extends Controller
{
    /**
     * Display a listing of activities.
     */
    public function index()
    {
        $kegiatans = Kegiatan::orderBy('tanggal', 'desc')->get();
        return view('admin.kegiatan.index', compact('kegiatans'));
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create()
    {
        return view('admin.kegiatan.create');
    }

    /**
     * Store a newly created activity in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $data = [
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/kegiatan');
            
            // Ensure folder exists
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            
            $file->move($destinationPath, $filename);
            $data['foto'] = 'uploads/kegiatan/' . $filename;
        }

        Kegiatan::create($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan RT berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified activity.
     */
    public function edit(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    /**
     * Update the specified activity in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
            'tanggal.required' => 'Tanggal kegiatan wajib diisi.',
            'lokasi.required' => 'Lokasi kegiatan wajib diisi.',
            'deskripsi.required' => 'Deskripsi kegiatan wajib diisi.',
            'foto.image' => 'Berkas foto harus berupa gambar.',
            'foto.mimes' => 'Format foto harus berupa jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        $data = [
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('foto')) {
            // Delete old photo if it exists
            if ($kegiatan->foto && File::exists(public_path($kegiatan->foto))) {
                File::delete(public_path($kegiatan->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/kegiatan');
            
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $filename);
            $data['foto'] = 'uploads/kegiatan/' . $filename;
        }

        $kegiatan->update($data);

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan RT berhasil diperbarui.');
    }

    /**
     * Remove the specified activity from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        
        // Delete photo if it exists
        if ($kegiatan->foto && File::exists(public_path($kegiatan->foto))) {
            File::delete(public_path($kegiatan->foto));
        }

        $kegiatan->delete();

        return redirect()->route('admin.kegiatan.index')->with('success', 'Kegiatan RT berhasil dihapus.');
    }
}
