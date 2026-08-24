<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 'evaluasi';
    protected $primaryKey = 'id_evaluasi';
    protected $fillable = [
        'id_instansi', 'id_asesor', 'tahun', 'status',
        'indeks_akhir', 'predikat', 'tanggal_mulai', 'tanggal_selesai',
    ];

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    public function asesor()
    {
        return $this->belongsTo(Asesor::class, 'id_asesor', 'id_asesor');
    }

    public function evaluasiIndikator()
    {
        return $this->hasMany(EvaluasiIndikator::class, 'id_evaluasi', 'id_evaluasi');
    }
}
