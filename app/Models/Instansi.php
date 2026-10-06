<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    protected $table = 'instansi';
    protected $primaryKey = 'id_instansi';
    protected $fillable = [
        'id_wilayah', 'kode_instansi', 'nama_instansi', 'kategori',
        'alamat', 'email', 'telepon', 'status', 'website',
    ];

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'id_wilayah', 'id_wilayah');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_instansi', 'id_instansi');
    }

    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class, 'id_instansi', 'id_instansi');
    }

    public function evaluasiTerbaru()
    {
        // Mengambil satu evaluasi paling baru milik instansi.
        return $this->hasOne(Evaluasi::class, 'id_instansi', 'id_instansi')
            ->latestOfMany('id_evaluasi');
    }
}
