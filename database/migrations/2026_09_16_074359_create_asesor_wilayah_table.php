<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel penghubung antara asesor dan wilayah.
     * Satu asesor bisa memiliki banyak wilayah penugasan.
     */
    public function up(): void
    {
        Schema::create('asesor_wilayah', function (Blueprint $table) {
            $table->id();

            // Asesor yang memiliki wilayah penugasan.
            $table->foreignId('id_asesor')
                ->constrained('asesor', 'id_asesor')
                ->cascadeOnDelete();

            // Wilayah yang menjadi cakupan tugas asesor.
            $table->foreignId('id_wilayah')
                ->constrained('wilayah', 'id_wilayah')
                ->cascadeOnDelete();

            // Satu asesor tidak boleh memiliki wilayah yang sama dua kali.
            $table->unique(['id_asesor', 'id_wilayah']);

            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel penghubung ketika migration di-rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesor_wilayah');
    }
};