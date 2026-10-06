<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    /**
     * Mengisi master wilayah berupa provinsi di Indonesia.
     */
    public function run(): void
    {
        $wilayah = [
            ['kode_wilayah' => '11', 'nama_wilayah' => 'Aceh'],
            ['kode_wilayah' => '12', 'nama_wilayah' => 'Sumatera Utara'],
            ['kode_wilayah' => '13', 'nama_wilayah' => 'Sumatera Barat'],
            ['kode_wilayah' => '14', 'nama_wilayah' => 'Riau'],
            ['kode_wilayah' => '15', 'nama_wilayah' => 'Jambi'],
            ['kode_wilayah' => '16', 'nama_wilayah' => 'Sumatera Selatan'],
            ['kode_wilayah' => '17', 'nama_wilayah' => 'Bengkulu'],
            ['kode_wilayah' => '18', 'nama_wilayah' => 'Lampung'],
            ['kode_wilayah' => '19', 'nama_wilayah' => 'Kepulauan Bangka Belitung'],
            ['kode_wilayah' => '21', 'nama_wilayah' => 'Kepulauan Riau'],

            ['kode_wilayah' => '31', 'nama_wilayah' => 'DKI Jakarta'],
            ['kode_wilayah' => '32', 'nama_wilayah' => 'Jawa Barat'],
            ['kode_wilayah' => '33', 'nama_wilayah' => 'Jawa Tengah'],
            ['kode_wilayah' => '34', 'nama_wilayah' => 'DI Yogyakarta'],
            ['kode_wilayah' => '35', 'nama_wilayah' => 'Jawa Timur'],
            ['kode_wilayah' => '36', 'nama_wilayah' => 'Banten'],

            ['kode_wilayah' => '51', 'nama_wilayah' => 'Bali'],
            ['kode_wilayah' => '52', 'nama_wilayah' => 'Nusa Tenggara Barat'],
            ['kode_wilayah' => '53', 'nama_wilayah' => 'Nusa Tenggara Timur'],

            ['kode_wilayah' => '61', 'nama_wilayah' => 'Kalimantan Barat'],
            ['kode_wilayah' => '62', 'nama_wilayah' => 'Kalimantan Tengah'],
            ['kode_wilayah' => '63', 'nama_wilayah' => 'Kalimantan Selatan'],
            ['kode_wilayah' => '64', 'nama_wilayah' => 'Kalimantan Timur'],
            ['kode_wilayah' => '65', 'nama_wilayah' => 'Kalimantan Utara'],

            ['kode_wilayah' => '71', 'nama_wilayah' => 'Sulawesi Utara'],
            ['kode_wilayah' => '72', 'nama_wilayah' => 'Sulawesi Tengah'],
            ['kode_wilayah' => '73', 'nama_wilayah' => 'Sulawesi Selatan'],
            ['kode_wilayah' => '74', 'nama_wilayah' => 'Sulawesi Tenggara'],
            ['kode_wilayah' => '75', 'nama_wilayah' => 'Gorontalo'],
            ['kode_wilayah' => '76', 'nama_wilayah' => 'Sulawesi Barat'],

            ['kode_wilayah' => '81', 'nama_wilayah' => 'Maluku'],
            ['kode_wilayah' => '82', 'nama_wilayah' => 'Maluku Utara'],

            ['kode_wilayah' => '91', 'nama_wilayah' => 'Papua Barat'],
            ['kode_wilayah' => '92', 'nama_wilayah' => 'Papua Barat Daya'],
            ['kode_wilayah' => '94', 'nama_wilayah' => 'Papua'],
            ['kode_wilayah' => '95', 'nama_wilayah' => 'Papua Selatan'],
            ['kode_wilayah' => '96', 'nama_wilayah' => 'Papua Tengah'],
            ['kode_wilayah' => '97', 'nama_wilayah' => 'Papua Pegunungan'],
        ];

        // Masukkan data provinsi ke tabel wilayah.
        Wilayah::insert($wilayah);
    }
}