<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

//pembuatan migration untuk rename kolom `nama` menjadi `name` di tabel `users` (Laravel default)

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE `users` CHANGE `nama` `name` VARCHAR(150) NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `users` CHANGE `name` `nama` VARCHAR(150) NOT NULL');
    }
};
