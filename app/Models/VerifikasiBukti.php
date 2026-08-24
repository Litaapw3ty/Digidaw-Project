<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiBukti extends Model
{
    protected $table = 'verifikasi_bukti';
    protected $primaryKey = 'id_verifikasi';
    public $timestamps = false;
    protected $fillable = ['id_dokumen', 'id_asesor', 'keputusan', 'catatan', 'verified_at'];

    protected function casts(): array
    {
        return ['verified_at' => 'datetime'];
    }

    public function dokumen()
    {
        return $this->belongsTo(DokumenBukti::class, 'id_dokumen', 'id_dokumen');
    }

    public function asesor()
    {
        return $this->belongsTo(Asesor::class, 'id_asesor', 'id_asesor');
    }
}
