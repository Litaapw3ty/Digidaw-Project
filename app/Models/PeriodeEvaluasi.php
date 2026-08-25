<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeriodeEvaluasi extends Model
{
    protected $table = 'periode_evaluasi';
    protected $primaryKey = 'id_periode';

    protected $fillable = [
        'tahun_anggaran',
        'tanggal_mulai_pengisian', 'tanggal_selesai_pengisian', 'status_pengisian_aktif',
        'tanggal_mulai_asesor', 'tanggal_selesai_asesor',
        'target_indeks_nasional',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai_pengisian' => 'date',
            'tanggal_selesai_pengisian' => 'date',
            'tanggal_mulai_asesor' => 'date',
            'tanggal_selesai_asesor' => 'date',
            'status_pengisian_aktif' => 'boolean',
        ];
    }

    /** Ambil periode tahun berjalan (dipakai buat cek "sekarang lagi boleh upload apa nggak") */
    public static function tahunIni(): ?self
    {
        return static::where('tahun_anggaran', now()->year)->first();
    }

    public function sedangBukaPengisian(): bool
    {
        if (! $this->status_pengisian_aktif) {
            return false;
        }

        $sekarang = now()->toDateString();

        return $sekarang >= $this->tanggal_mulai_pengisian?->toDateString()
            && $sekarang <= $this->tanggal_selesai_pengisian?->toDateString();
    }
}
