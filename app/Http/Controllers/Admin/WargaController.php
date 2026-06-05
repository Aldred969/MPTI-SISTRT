<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    public function index(Request $request)
{
    $keyword = $request->keyword;

    $warga = User::where('role', 'warga')
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('nama', 'like', "%{$keyword}%")
                  ->orWhere('nik', 'like', "%{$keyword}%");
        })
        ->latest()
        ->paginate(10);

    return view('admin.warga.index', compact('warga'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users',
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'no_hp' => 'nullable',
            'password' => 'required|min:6'
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => 'warga',
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('warga.index')
            ->with('success','Data warga berhasil ditambahkan');
    }

    public function edit(User $warga)
    {
        return view('admin.warga.edit', compact('warga'));
    }

    public function update(Request $request, User $warga)
{
    $request->validate([
        'nik' => 'required',
        'nama' => 'required',
        'email' => 'required|email',
    ]);

    $warga->update([
        'nik' => $request->nik,
        'nama' => $request->nama,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
    ]);

    return redirect()
        ->route('warga.index')
        ->with('success','Data warga berhasil diperbarui');
}
    public function destroy(User $warga)
    {
        $warga->delete();

        return redirect()
            ->route('warga.index')
            ->with('success','Data warga berhasil dihapus');
    }
}