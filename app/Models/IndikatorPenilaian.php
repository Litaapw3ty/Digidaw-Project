<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorPenilaian extends Model
{
    protected $table = 'indikator_penilaian';
    protected $primaryKey = 'id_indikator';
    protected $fillable = [
        'id_aspek', 'nomor_indikator', 'kode_indikator', 'nama_indikator',
        'sumber_indikator', 'bobot', 'status',
    ];

    public function aspek()
    {
        return $this->belongsTo(AspekPenilaian::class, 'id_aspek', 'id_aspek');
    }

    public function kriteria()
    {
        return $this->hasMany(IndikatorKriteria::class, 'id_indikator', 'id_indikator');
    }

    public function dataDukung()
    {
        return $this->hasMany(DataDukung::class, 'id_indikator', 'id_indikator')
            ->orderBy('id_tingkat')->orderBy('nomor');
    }

    public function isEksternal(): bool
    {
        return $this->sumber_indikator === 'EKSTERNAL';
    }
}
