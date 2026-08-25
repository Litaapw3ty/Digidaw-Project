<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Patch skema berdasarkan analisis desain Figma vs database:
 *
 * 1. Tabel baru `periode_evaluasi` -- pengaturan global per tahun anggaran
 *    (jadwal buka-tutup pengisian & periode asesor, target indeks nasional).
 *    Sebelumnya cuma ada kolom `tahun` polos di tabel `evaluasi`, belum ada
 *    tempat nyimpen jadwal & target ini.
 *
 * 2. Kolom `nip` di `users` -- form Tambah User di Figma punya field NIP,
 *    ternyata bukan cuma Asesor yang punya NIP.
 *
 * 3. Kolom `keahlian` di `asesor` -- form Tambah Asesor punya field
 *    "Keahlian / Spesialisasi" yang belum ada tempatnya.
 *
 * 4. Kolom `id_instansi` di `asesor` -- klarifikasi dari tim: field
 *    "Instansi" di form Tambah Asesor itu instansi yang JADI TANGGUNG
 *    JAWAB asesor tsb untuk dinilai (assignment tetap), bukan instansi
 *    asal dia bekerja. ini melengkapi (bukan menggantikan) evaluasi.id_asesor
 *    yang sudah ada -- id_instansi di sini jadi assignment "default/saat
 *    ini", sedangkan evaluasi.id_asesor tetap jadi catatan historis per
 *    tahun (kalau ada pergantian asesor di tahun berikutnya).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periode_evaluasi', function (Blueprint $table) {
            $table->id('id_periode');
            $table->smallInteger('tahun_anggaran')->unsigned()->unique();

            $table->date('tanggal_mulai_pengisian')->nullable();
            $table->date('tanggal_selesai_pengisian')->nullable();
            $table->boolean('status_pengisian_aktif')->default(false);

            $table->date('tanggal_mulai_asesor')->nullable();
            $table->date('tanggal_selesai_asesor')->nullable();

            $table->decimal('target_indeks_nasional', 3, 1)->nullable();

            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('nip', 50)->nullable()->after('no_hp');
        });

        Schema::table('asesor', function (Blueprint $table) {
            $table->string('keahlian', 255)->nullable()->after('jabatan');
            $table->foreignId('id_instansi')
                ->nullable()
                ->after('id_user')
                ->constrained('instansi', 'id_instansi')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('asesor', function (Blueprint $table) {
            $table->dropConstrainedForeignId('id_instansi');
            $table->dropColumn('keahlian');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nip');
        });

        Schema::dropIfExists('periode_evaluasi');
    }
};
