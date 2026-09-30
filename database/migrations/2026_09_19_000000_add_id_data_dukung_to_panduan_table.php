<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('panduan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_data_dukung')
                ->nullable()
                ->after('id_indikator');

            $table->foreign('id_data_dukung')
                ->references('id_data_dukung')
                ->on('data_dukung')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('panduan', function (Blueprint $table) {
            $table->dropForeign(['id_data_dukung']);
            $table->dropColumn('id_data_dukung');
        });
    }
};
