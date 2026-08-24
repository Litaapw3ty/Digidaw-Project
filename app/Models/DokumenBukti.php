<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenBukti extends Model
{
    protected $table = 'dokumen_bukti';
    protected $primaryKey = 'id_dokumen';
    const UPDATED_AT = null; // tabel ini cuma punya created_at

    protected $fillable = [
        'id_evaluasi_data_dukung', 'uploaded_by', 'file_name', 'file_path',
        'file_type', 'file_size', 'catatan_user', 'versi', 'status',
    ];

    public function evaluasiDataDukung()
    {
        return $this->belongsTo(EvaluasiDataDukung::class, 'id_evaluasi_data_dukung', 'id_evaluasi_data_dukung');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id_user');
    }

    public function verifikasi()
    {
        return $this->hasOne(VerifikasiBukti::class, 'id_dokumen', 'id_dokumen');
    }
}
