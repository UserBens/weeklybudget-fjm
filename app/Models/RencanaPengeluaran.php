<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RencanaPengeluaran extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_input' => 'date',
        'bulan'         => 'integer',
        'minggu'        => 'integer',
        'nominal'       => 'integer',
    ];

    // ── Helper: nama bulan dalam Bahasa Indonesia ──
    public function getNamaBulanAttribute(): string
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulan[$this->bulan] ?? '-';
    }

    // ── Helper: format nominal ke rupiah ──
    public function getNominalFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }

    // ── Relasi ke User (opsional, uncomment jika auth aktif) ──
    // public function creator()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }
}
