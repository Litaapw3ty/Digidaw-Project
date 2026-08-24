<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluasiDataDukung extends Model
{
    protected $table = 'evaluasi_data_dukung';
    protected $primaryKey = 'id_evaluasi_data_dukung';
    protected $fillable = ['id_evaluasi_indikator', 'id_data_dukung', 'status', 'keterangan'];

    public function evaluasiIndikator()
    {
        return $this->belongsTo(EvaluasiIndikator::class, 'id_evaluasi_indikator', 'id_evaluasi_indikator');
    }

    public function dataDukungMaster()
    {
        return $this->belongsTo(DataDukung::class, 'id_data_dukung', 'id_data_dukung');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenBukti::class, 'id_evaluasi_data_dukung', 'id_evaluasi_data_dukung');
    }

    public function dokumenAktif()
    {
        return $this->hasOne(DokumenBukti::class, 'id_evaluasi_data_dukung', 'id_evaluasi_data_dukung')
            ->where('status', 'AKTIF')->latest('versi');
    }
}
