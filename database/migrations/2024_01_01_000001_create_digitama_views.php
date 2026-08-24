<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

//pembuatan view `vw_hasil_evaluasi` & `vw_ringkasan_instansi` untuk mempermudah query hasil evaluasi dan ringkasan instansi

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared(<<<'SQL'
DROP TABLE IF EXISTS `vw_hasil_evaluasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_hasil_evaluasi`  AS SELECT `e`.`id_evaluasi` AS `id_evaluasi`, `e`.`tahun` AS `tahun`, `i`.`id_instansi` AS `id_instansi`, `i`.`kode_instansi` AS `kode_instansi`, `i`.`nama_instansi` AS `nama_instansi`, `a`.`nomor_aspek` AS `nomor_aspek`, `a`.`nama_aspek` AS `nama_aspek`, `ip`.`nomor_indikator` AS `nomor_indikator`, `ip`.`kode_indikator` AS `kode_indikator`, `ip`.`nama_indikator` AS `nama_indikator`, `ip`.`sumber_indikator` AS `sumber_indikator`, `ip`.`bobot` AS `bobot`, `ei`.`status_pengisian` AS `status_pengisian`, `ei`.`nilai` AS `nilai`, `ei`.`level_kematangan` AS `level_kematangan`, `ei`.`catatan_asesor` AS `catatan_asesor` FROM ((((`evaluasi` `e` join `instansi` `i` on((`i`.`id_instansi` = `e`.`id_instansi`))) join `evaluasi_indikator` `ei` on((`ei`.`id_evaluasi` = `e`.`id_evaluasi`))) join `indikator_penilaian` `ip` on((`ip`.`id_indikator` = `ei`.`id_indikator`))) join `aspek_penilaian` `a` on((`a`.`id_aspek` = `ip`.`id_aspek`))) ;

DROP TABLE IF EXISTS `vw_ringkasan_instansi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ringkasan_instansi`  AS SELECT `i`.`id_instansi` AS `id_instansi`, `i`.`kode_instansi` AS `kode_instansi`, `i`.`nama_instansi` AS `nama_instansi`, `i`.`kategori` AS `kategori`, `i`.`status` AS `status_instansi`, `e`.`id_evaluasi` AS `id_evaluasi`, `e`.`tahun` AS `tahun`, `e`.`status` AS `status_evaluasi`, `e`.`id_asesor` AS `id_asesor`, count(`ei`.`id_evaluasi_indikator`) AS `total_indikator`, sum((case when (`ei`.`status_pengisian` in ('TERKIRIM','DIVERIFIKASI','PERLU_PERBAIKAN')) then 1 else 0 end)) AS `indikator_terisi`, (case when (count(`ei`.`id_evaluasi_indikator`) = 0) then 0 else round(((sum((case when (`ei`.`status_pengisian` in ('TERKIRIM','DIVERIFIKASI','PERLU_PERBAIKAN')) then 1 else 0 end)) / count(`ei`.`id_evaluasi_indikator`)) * 100),2) end) AS `progress_persen`, `e`.`indeks_akhir` AS `indeks_akhir` FROM ((`instansi` `i` left join `evaluasi` `e` on((`e`.`id_instansi` = `i`.`id_instansi`))) left join `evaluasi_indikator` `ei` on((`ei`.`id_evaluasi` = `e`.`id_evaluasi`))) GROUP BY `i`.`id_instansi`, `i`.`kode_instansi`, `i`.`nama_instansi`, `i`.`kategori`, `i`.`status`, `e`.`id_evaluasi`, `e`.`tahun`, `e`.`status`, `e`.`id_asesor`, `e`.`indeks_akhir` ;

SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP VIEW IF EXISTS `vw_hasil_evaluasi`; DROP VIEW IF EXISTS `vw_ringkasan_instansi`;');
    }
};
