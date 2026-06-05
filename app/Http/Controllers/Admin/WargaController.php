<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = User::where('role', 'warga')->orderBy('nama', 'asc')->get();
        return view('admin.warga.index', compact('warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:users,nik',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus bernilai 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama warga wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal berisi 8 karakter.',
        ]);

        User::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => 'warga',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warga = User::where('role', 'warga')->findOrFail($id);
        return view('admin.warga.edit', compact('warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warga = User::where('role', 'warga')->findOrFail($id);

        $request->validate([
            'nik' => [
                'required',
                'string',
                'size:16',
                Rule::unique('users', 'nik')->ignore($warga->id),
            ],
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($warga->id),
            ],
            'no_hp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus bernilai 16 karakter.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama.required' => 'Nama warga wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Kata sandi minimal berisi 8 karakter.',
        ]);

        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $warga->update($data);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = User::where('role', 'warga')->findOrFail($id);
        $warga->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
