<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataDukung extends Model
{
    protected $table = 'data_dukung';
    protected $primaryKey = 'id_data_dukung';
    protected $fillable = [
        'id_indikator', 'id_tingkat', 'nomor', 'nama_data_dukung',
        'bobot', 'deskripsi', 'format_file', 'status',
    ];

    public function indikator()
    {
        return $this->belongsTo(IndikatorPenilaian::class, 'id_indikator', 'id_indikator');
    }

    public function tingkat()
    {
        return $this->belongsTo(TingkatKematangan::class, 'id_tingkat', 'id_tingkat');
    }
}
