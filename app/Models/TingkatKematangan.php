<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TingkatKematangan extends Model
{
    protected $table = 'tingkat_kematangan';
    protected $primaryKey = 'id_tingkat';
    public $timestamps = false;
    protected $fillable = ['level', 'nama_level', 'deskripsi', 'nilai_min', 'nilai_max'];

    //Cari level berdasarkan nilai akhir (dibulatkan 2 desimal, batas >= konsisten
    public static function fromNilai(float $nilai): ?self
    {
        $nilai = round($nilai, 2);
        return static::orderByDesc('level')
            ->where('nilai_min', '<=', $nilai)
            ->first();
    }
}
