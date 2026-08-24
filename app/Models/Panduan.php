<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panduan extends Model
{
    protected $table = 'panduan';
    protected $primaryKey = 'id_panduan';
    protected $fillable = [
        'id_asesor', 'id_aspek', 'id_indikator', 'judul', 'deskripsi',
        'tipe', 'file_path', 'file_name', 'status', 'created_by',
    ];

    public function asesor()
    {
        return $this->belongsTo(Asesor::class, 'id_asesor', 'id_asesor');
    }

    public function aspek()
    {
        return $this->belongsTo(AspekPenilaian::class, 'id_aspek', 'id_aspek');
    }

    public function indikator()
    {
        return $this->belongsTo(IndikatorPenilaian::class, 'id_indikator', 'id_indikator');
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'created_by', 'id_user');
    }
}
