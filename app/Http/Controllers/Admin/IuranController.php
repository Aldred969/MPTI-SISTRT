<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Iuran;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IuranController extends Controller
{
    // List of months in Indonesian
    private $months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    /**
     * Display the iuran history of a specific citizen.
     */
    public function history(string $warga_id)
    {
        $warga = User::where('role', 'warga')->findOrFail($warga_id);
        $iurans = Iuran::where('user_id', $warga_id)->orderBy('tahun', 'desc')->orderByRaw("FIELD(bulan, 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember') desc")->get();

        return view('admin.iuran.history', compact('warga', 'iurans'));
    }

    /**
     * Show the form for creating a new iuran record.
     */
    public function create(Request $request)
    {
        $selectedWargaId = $request->query('warga_id');
        $wargas = User::where('role', 'warga')->orderBy('nama', 'asc')->get();
        $months = $this->months;
        $years = range(date('Y') - 2, date('Y') + 2);

        return view('admin.iuran.create', compact('wargas', 'selectedWargaId', 'months', 'years'));
    }

    /**
     * Store a newly created iuran record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:2100',
            'nominal' => 'required|numeric|min:0',
            'status' => 'required|in:belum_bayar,lunas',
            'tanggal_bayar' => 'nullable|date|required_if:status,lunas',
        ], [
            'user_id.required' => 'Warga harus dipilih.',
            'bulan.required' => 'Bulan harus dipilih.',
            'tahun.required' => 'Tahun harus dipilih.',
            'nominal.required' => 'Nominal iuran wajib diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'tanggal_bayar.required_if' => 'Tanggal pembayaran wajib diisi jika status Lunas.',
        ]);

        // Check if duplicate record exists
        $exists = Iuran::where('user_id', $request->user_id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Catatan iuran untuk warga pada bulan dan tahun tersebut sudah ada.');
        }

        Iuran::create([
            'user_id' => $request->user_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
            'status' => $request->status,
            'tanggal_bayar' => $request->status === 'lunas' ? $request->tanggal_bayar : null,
        ]);

        return redirect()->route('admin.iuran.history', $request->user_id)->with('success', 'Catatan iuran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing an iuran record.
     */
    public function edit(string $id)
    {
        $iuran = Iuran::findOrFail($id);
        $warga = $iuran->user;
        $months = $this->months;
        $years = range(date('Y') - 2, date('Y') + 2);

        return view('admin.iuran.edit', compact('iuran', 'warga', 'months', 'years'));
    }

    /**
     * Update the specified iuran record.
     */
    public function update(Request $request, string $id)
    {
        $iuran = Iuran::findOrFail($id);

        $request->validate([
            'bulan' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:2100',
            'nominal' => 'required|numeric|min:0',
            'status' => 'required|in:belum_bayar,lunas',
            'tanggal_bayar' => 'nullable|date|required_if:status,lunas',
        ], [
            'bulan.required' => 'Bulan harus dipilih.',
            'tahun.required' => 'Tahun harus dipilih.',
            'nominal.required' => 'Nominal iuran wajib diisi.',
            'nominal.numeric' => 'Nominal harus berupa angka.',
            'tanggal_bayar.required_if' => 'Tanggal pembayaran wajib diisi jika status Lunas.',
        ]);

        // Check duplicate excluding self
        $exists = Iuran::where('user_id', $iuran->user_id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->where('id', '!=', $iuran->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Catatan iuran untuk warga pada bulan dan tahun tersebut sudah ada.');
        }

        $iuran->update([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'nominal' => $request->nominal,
            'status' => $request->status,
            'tanggal_bayar' => $request->status === 'lunas' ? $request->tanggal_bayar : null,
        ]);

        return redirect()->route('admin.iuran.history', $iuran->user_id)->with('success', 'Catatan iuran berhasil diperbarui.');
    }

    /**
     * Quick action to pay/mark as lunas.
     */
    public function pay(string $id)
    {
        $iuran = Iuran::findOrFail($id);
        $iuran->update([
            'status' => 'lunas',
            'tanggal_bayar' => Carbon::now()->toDateString(),
        ]);

        return redirect()->back()->with('success', 'Iuran warga berhasil ditandai sebagai LUNAS.');
    }

    /**
     * Remove the iuran record.
     */
    public function destroy(string $id)
    {
        $iuran = Iuran::findOrFail($id);
        $warga_id = $iuran->user_id;
        $iuran->delete();

        return redirect()->route('admin.iuran.history', $warga_id)->with('success', 'Catatan iuran berhasil dihapus.');
    }

    /**
     * Unpaid citizens report.
     */
    public function report(Request $request)
    {
        // Default filter: current month and year
        $months = $this->months;
        $currentMonthIdx = (int)date('n') - 1;
        $defaultMonth = $this->months[$currentMonthIdx];
        
        $selectedBulan = $request->input('bulan', $defaultMonth);
        $selectedTahun = $request->input('tahun', date('Y'));
        
        $years = Iuran::select('tahun')->groupBy('tahun')->orderBy('tahun', 'desc')->pluck('tahun')->toArray();
        if (empty($years)) {
            $years = [date('Y')];
        }

        // Get warga who have not paid (either status is 'belum_bayar' or they have no record at all)
        $unpaidWarga = User::where('role', 'warga')
            ->where(function($query) use ($selectedBulan, $selectedTahun) {
                $query->whereDoesntHave('iuran', function($q) use ($selectedBulan, $selectedTahun) {
                    $q->where('bulan', $selectedBulan)->where('tahun', $selectedTahun);
                })
                ->orWhereHas('iuran', function($q) use ($selectedBulan, $selectedTahun) {
                    $q->where('bulan', $selectedBulan)->where('tahun', $selectedTahun)->where('status', 'belum_bayar');
                });
            })
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.iuran.report', compact('unpaidWarga', 'selectedBulan', 'selectedTahun', 'months', 'years'));
    }

    /**
     * Summary of iuran collections.
     */
    public function total(Request $request)
    {
        $selectedTahun = $request->input('tahun', date('Y'));
        
        $years = Iuran::select('tahun')->groupBy('tahun')->orderBy('tahun', 'desc')->pluck('tahun')->toArray();
        if (empty($years)) {
            $years = [date('Y')];
        }

        $reportData = [];
        $grandTotalPaid = 0;
        $grandTotalUnpaid = 0;

        foreach ($this->months as $month) {
            $paid = Iuran::where('tahun', $selectedTahun)
                ->where('bulan', $month)
                ->where('status', 'lunas')
                ->sum('nominal');

            $unpaid = Iuran::where('tahun', $selectedTahun)
                ->where('bulan', $month)
                ->where('status', 'belum_bayar')
                ->sum('nominal');

            $total = $paid + $unpaid;

            $reportData[] = [
                'bulan' => $month,
                'paid' => $paid,
                'unpaid' => $unpaid,
                'total' => $total,
            ];

            $grandTotalPaid += $paid;
            $grandTotalUnpaid += $unpaid;
        }

        return view('admin.iuran.total', compact('reportData', 'selectedTahun', 'years', 'grandTotalPaid', 'grandTotalUnpaid'));
    }
}
