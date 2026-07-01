<?php

namespace App\Http\Controllers;

use App\Models\RencanaPengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    private array $kategoriList = [
        'Operasional Kantor',
        'Transportasi',
        'Pemeliharaan',
        'ATK & Perlengkapan',
        'Konsumsi Rapat',
        'Lain-lain',
    ];

    public function indexPengeluaran(Request $request)
    {
        $query = RencanaPengeluaran::query()->orderBy('created_at', 'desc');

        // Searching across beberapa kolom
        if ($search = $request->query('q')) {
            $query->where(function ($w) use ($search) {
                $w->where('dibayarkan_kepada', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%")
                    ->orWhere('no_dokumen', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($kategori = $request->query('kategori')) {
            $query->where('kategori', $kategori);
        }
        if ($bulan = $request->query('bulan')) {
            $query->where('bulan', $bulan);
        }
        if ($minggu = $request->query('minggu')) {
            $query->where('minggu', $minggu);
        }
        if ($tipe = $request->query('tipe')) {
            $query->where('tipe', $tipe);
        }

        $perPage = (int) $request->query('per_page', 10);
        $perPage = $perPage < 1 ? 10 : ($perPage > 100 ? 100 : $perPage);

        $pengeluarans = $query->orderBy('tanggal_input', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('pengeluaran.index', [
            'kategoriList' => $this->kategoriList,
            'pengeluarans' => $pengeluarans,
        ]);
    }

    public function createPengeluaran()
    {
        return view('pengeluaran.create', [
            'kategoriList' => $this->kategoriList,
        ]);
    }

    public function storePengeluaran(Request $request)
    {
        $validated = $request->validate([
            'tanggal_input'     => 'required|date',
            'bulan'             => 'required|integer|between:1,12',
            'minggu'            => 'required|integer|between:1,4',
            'kategori'          => 'required|string|max:100',
            'tipe'              => 'required|in:BAPP,Uang Muka',
            'dibayarkan_kepada' => 'required|string|max:255',
            'keterangan'        => 'nullable|string|max:1000',
            'nominal'           => 'required|integer|min:1',
            'no_dokumen'        => 'nullable|string|max:100',
        ], [
            'tanggal_input.required'     => 'Tanggal input wajib diisi.',
            'bulan.required'             => 'Bulan wajib dipilih.',
            'minggu.required'            => 'Minggu wajib dipilih.',
            'kategori.required'          => 'Kategori pengeluaran wajib dipilih.',
            'tipe.required'              => 'Tipe (BAPP / Uang Muka) wajib dipilih.',
            'dibayarkan_kepada.required' => 'Nama penerima pembayaran wajib diisi.',
            'nominal.required'           => 'Nominal wajib diisi.',
            'nominal.min'                => 'Nominal harus lebih dari 0.',
        ]);

        RencanaPengeluaran::create([
            'tanggal_input'     => $validated['tanggal_input'],
            'bulan'             => $validated['bulan'],
            'minggu'            => $validated['minggu'],
            'kategori'          => $validated['kategori'],
            'tipe'              => $validated['tipe'],
            'dibayarkan_kepada' => $validated['dibayarkan_kepada'],
            'keterangan'        => $validated['keterangan'] ?? null,
            'nominal'           => $validated['nominal'],
            'no_dokumen'        => $validated['no_dokumen'] ?? null,
            'created_by'        => auth()->id() ?? null,
        ]);

        // return redirect()
        //     ->route('pengeluaran.index')
        //     ->with('success', 'Rencana pengeluaran berhasil disimpan.');

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil disimpan.');
    }
}
