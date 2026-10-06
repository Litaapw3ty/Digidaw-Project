<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table = 'asesor';
    protected $primaryKey = 'id_asesor';
    protected $fillable = [
        'id_user', 'id_instansi', 'nip', 'jabatan', 'keahlian',
        'unit_kerja', 'status', 'wilayah',
    ];
    protected $casts = [
    'keahlian' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /** Instansi yang jadi tanggung jawab tetap Asesor ini untuk dinilai. */
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    public function evaluasiDitangani()
    {
        return $this->hasMany(Evaluasi::class, 'id_asesor', 'id_asesor');
    }

    public function panduan()
    {
        return $this->hasMany(Panduan::class, 'id_asesor', 'id_asesor');
    }

    public function verifikasi()
    {
        return $this->hasMany(VerifikasiBukti::class, 'id_asesor', 'id_asesor');
    }
    /** Wilayah yang menjadi penugasan asesor. Satu asesor bisa memiliki banyak wilayah.*/
    public function wilayahPenugasan()
    {
        return $this->belongsToMany(
            Wilayah::class,
            'asesor_wilayah',
            'id_asesor',
            'id_wilayah'
        );
    }   
}
