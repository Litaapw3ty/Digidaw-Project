<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id_wilayah';
    protected $fillable = ['kode_wilayah', 'nama_wilayah'];

    public function instansi()
    {
        return $this->hasMany(Instansi::class, 'id_wilayah', 'id_wilayah');
    }
}
