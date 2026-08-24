<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiIndikator extends Model
{
    protected $table = 'evaluasi_indikator';
    protected $primaryKey = 'id_evaluasi_indikator';
    const CREATED_AT = null; // tabel ini cuma punya updated_at
    protected $fillable = [
        'id_evaluasi', 'id_indikator', 'status_pengisian',
        'nilai', 'level_kematangan', 'catatan_asesor',
    ];

    public function evaluasi()
    {
        return $this->belongsTo(Evaluasi::class, 'id_evaluasi', 'id_evaluasi');
    }

    public function indikator()
    {
        return $this->belongsTo(IndikatorPenilaian::class, 'id_indikator', 'id_indikator');
    }

    public function dataDukung()
    {
        return $this->hasMany(EvaluasiDataDukung::class, 'id_evaluasi_indikator', 'id_evaluasi_indikator');
    }
}
