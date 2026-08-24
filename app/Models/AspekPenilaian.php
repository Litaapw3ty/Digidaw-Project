<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AspekPenilaian extends Model
{
    protected $table = 'aspek_penilaian';
    protected $primaryKey = 'id_aspek';
    protected $fillable = ['nomor_aspek', 'nama_aspek', 'deskripsi', 'bobot', 'status'];

    public function indikator()
    {
        return $this->hasMany(IndikatorPenilaian::class, 'id_aspek', 'id_aspek')->orderBy('nomor_indikator');
    }

    public function panduan()
    {
        return $this->hasMany(Panduan::class, 'id_aspek', 'id_aspek');
    }
}
