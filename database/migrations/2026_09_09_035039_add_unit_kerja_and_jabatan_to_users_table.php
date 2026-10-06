<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Mengubah kolom keahlian agar bisa menyimpan
     * lebih dari satu aspek dalam bentuk JSON.
     */
    public function up(): void
    {
        Schema::table('asesor', function (Blueprint $table) {
            $table->json('keahlian')->nullable()->change();
        });
    }

    /**
     * Mengembalikan kolom keahlian ke varchar
     * jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::table('asesor', function (Blueprint $table) {
            $table->string('keahlian', 255)->nullable()->change();
        });
    }
};