<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndikatorKriteria extends Model
{
    protected $table = 'indikator_kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $fillable = ['id_indikator', 'id_tingkat', 'kriteria', 'bukti_yang_dibutuhkan'];

    public function indikator()
    {
        return $this->belongsTo(IndikatorPenilaian::class, 'id_indikator', 'id_indikator');
    }

    public function tingkat()
    {
        return $this->belongsTo(TingkatKematangan::class, 'id_tingkat', 'id_tingkat');
    }
}
