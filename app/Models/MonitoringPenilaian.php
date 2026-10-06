<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringPenilaian extends Model
{
    // Model ini membaca data dari database view,
    // bukan dari tabel biasa.
    protected $table = 'vw_ringkasan_instansi';

    // View tidak memiliki primary key khusus.
    public $incrementing = false;

    protected $primaryKey = null;

    // View hanya digunakan untuk membaca data.
    public $timestamps = false;

    protected $guarded = [];
}