<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

//pembuatan schema database Digitama (tabel, kolom, tipe data, relasi, index, primary key, foreign key)

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared(<<<'SQL'

CREATE TABLE `wilayah` (
  `id_wilayah` bigint UNSIGNED NOT NULL,
  `kode_wilayah` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_wilayah` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `id_role` bigint UNSIGNED NOT NULL,
  `nama_role` enum('ADMIN','USER','ASESOR') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `tingkat_kematangan` (
  `id_tingkat` bigint UNSIGNED NOT NULL,
  `level` tinyint UNSIGNED NOT NULL,
  `nama_level` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `nilai_min` decimal(6,2) DEFAULT NULL,
  `nilai_max` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `aspek_penilaian` (
  `id_aspek` bigint UNSIGNED NOT NULL,
  `nomor_aspek` tinyint UNSIGNED NOT NULL,
  `nama_aspek` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `instansi` (
  `id_instansi` bigint UNSIGNED NOT NULL,
  `id_wilayah` bigint UNSIGNED DEFAULT NULL,
  `kode_instansi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_instansi` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` enum('PUSAT','PROVINSI','KABUPATEN','KOTA','LAINNYA') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'LAINNYA',
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telepon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `id_role` bigint UNSIGNED NOT NULL,
  `id_instansi` bigint UNSIGNED DEFAULT NULL,
  `nama` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `asesor` (
  `id_asesor` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_kerja` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `wilayah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `indikator_penilaian` (
  `id_indikator` bigint UNSIGNED NOT NULL,
  `id_aspek` bigint UNSIGNED NOT NULL,
  `nomor_indikator` int UNSIGNED NOT NULL,
  `kode_indikator` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_indikator` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_indikator` enum('INTERNAL','EKSTERNAL') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INTERNAL',
  `bobot` decimal(5,2) NOT NULL DEFAULT '0.00',
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `indikator_kriteria` (
  `id_kriteria` bigint UNSIGNED NOT NULL,
  `id_indikator` bigint UNSIGNED NOT NULL,
  `id_tingkat` bigint UNSIGNED NOT NULL,
  `kriteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_yang_dibutuhkan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `data_dukung` (
  `id_data_dukung` bigint UNSIGNED NOT NULL,
  `id_indikator` bigint UNSIGNED NOT NULL,
  `id_tingkat` bigint UNSIGNED NOT NULL,
  `nomor` int UNSIGNED NOT NULL DEFAULT '1',
  `nama_data_dukung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `format_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `evaluasi` (
  `id_evaluasi` bigint UNSIGNED NOT NULL,
  `id_instansi` bigint UNSIGNED NOT NULL,
  `id_asesor` bigint UNSIGNED DEFAULT NULL,
  `tahun` smallint UNSIGNED NOT NULL,
  `status` enum('DRAFT','PENGISIAN','MENUNGGU_VERIFIKASI','DALAM_PENILAIAN','SELESAI','DITUTUP') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DRAFT',
  `indeks_akhir` decimal(6,2) DEFAULT NULL,
  `predikat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `evaluasi_indikator` (
  `id_evaluasi_indikator` bigint UNSIGNED NOT NULL,
  `id_evaluasi` bigint UNSIGNED NOT NULL,
  `id_indikator` bigint UNSIGNED NOT NULL,
  `status_pengisian` enum('BELUM_DIISI','DRAFT','TERKIRIM','DIVERIFIKASI','PERLU_PERBAIKAN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BELUM_DIISI',
  `nilai` decimal(6,2) DEFAULT NULL,
  `level_kematangan` tinyint UNSIGNED DEFAULT NULL,
  `catatan_asesor` text COLLATE utf8mb4_unicode_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `evaluasi_data_dukung` (
  `id_evaluasi_data_dukung` bigint UNSIGNED NOT NULL,
  `id_evaluasi_indikator` bigint UNSIGNED NOT NULL,
  `id_data_dukung` bigint UNSIGNED NOT NULL,
  `status` enum('BELUM_DIISI','TERKIRIM','DIVERIFIKASI','PERLU_PERBAIKAN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'BELUM_DIISI',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `dokumen_bukti` (
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `id_evaluasi_data_dukung` bigint UNSIGNED NOT NULL,
  `uploaded_by` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` bigint UNSIGNED DEFAULT NULL,
  `catatan_user` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `versi` int UNSIGNED NOT NULL DEFAULT '1',
  `status` enum('AKTIF','DIGANTI','DIHAPUS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `verifikasi_bukti` (
  `id_verifikasi` bigint UNSIGNED NOT NULL,
  `id_dokumen` bigint UNSIGNED NOT NULL,
  `id_asesor` bigint UNSIGNED NOT NULL,
  `keputusan` enum('DISETUJUI','PERLU_PERBAIKAN','DITOLAK') COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `verified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `panduan` (
  `id_panduan` bigint UNSIGNED NOT NULL,
  `id_asesor` bigint UNSIGNED DEFAULT NULL,
  `id_aspek` bigint UNSIGNED DEFAULT NULL,
  `id_indikator` bigint UNSIGNED DEFAULT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `tipe` enum('PANDUAN','TEMPLATE','DOKUMEN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PANDUAN',
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'AKTIF',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `audit_log` (
  `id_log` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED DEFAULT NULL,
  `aksi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tabel_target` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_target` bigint UNSIGNED DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============ PATCH KOLOM (bobot + widen text) ============

ALTER TABLE `aspek_penilaian` ADD COLUMN `bobot` DECIMAL(5,2) NOT NULL DEFAULT 0.00 AFTER `nama_aspek`;
ALTER TABLE `data_dukung` ADD COLUMN `bobot` DECIMAL(6,4) NOT NULL DEFAULT 0.0000 AFTER `nama_data_dukung`;
ALTER TABLE `data_dukung` MODIFY COLUMN `nama_data_dukung` TEXT NOT NULL;

-- ============ INDEXES ============
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`id_asesor`),
  ADD UNIQUE KEY `id_user` (`id_user`),
  ADD UNIQUE KEY `nip` (`nip`);

ALTER TABLE `aspek_penilaian`
  ADD PRIMARY KEY (`id_aspek`),
  ADD UNIQUE KEY `nomor_aspek` (`nomor_aspek`);

ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `idx_audit_user` (`id_user`),
  ADD KEY `idx_audit_target` (`tabel_target`,`id_target`);

ALTER TABLE `data_dukung`
  ADD PRIMARY KEY (`id_data_dukung`),
  ADD UNIQUE KEY `uk_data_dukung_nomor` (`id_indikator`,`id_tingkat`,`nomor`),
  ADD KEY `fk_data_dukung_tingkat` (`id_tingkat`);

ALTER TABLE `dokumen_bukti`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `fk_dokumen_uploader` (`uploaded_by`),
  ADD KEY `idx_dokumen_eval_data` (`id_evaluasi_data_dukung`);

ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`),
  ADD UNIQUE KEY `uk_evaluasi_instansi_tahun` (`id_instansi`,`tahun`),
  ADD KEY `fk_evaluasi_asesor` (`id_asesor`),
  ADD KEY `idx_evaluasi_status` (`status`),
  ADD KEY `idx_evaluasi_tahun` (`tahun`);

ALTER TABLE `evaluasi_data_dukung`
  ADD PRIMARY KEY (`id_evaluasi_data_dukung`),
  ADD UNIQUE KEY `uk_eval_data_dukung` (`id_evaluasi_indikator`,`id_data_dukung`),
  ADD KEY `fk_eval_data_master` (`id_data_dukung`);

ALTER TABLE `evaluasi_indikator`
  ADD PRIMARY KEY (`id_evaluasi_indikator`),
  ADD UNIQUE KEY `uk_evaluasi_indikator` (`id_evaluasi`,`id_indikator`),
  ADD KEY `fk_eval_indikator_master` (`id_indikator`),
  ADD KEY `fk_eval_indikator_level` (`level_kematangan`),
  ADD KEY `idx_eval_indikator_status` (`status_pengisian`);

ALTER TABLE `indikator_kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD UNIQUE KEY `uk_indikator_tingkat` (`id_indikator`,`id_tingkat`),
  ADD KEY `fk_kriteria_tingkat` (`id_tingkat`);

ALTER TABLE `indikator_penilaian`
  ADD PRIMARY KEY (`id_indikator`),
  ADD UNIQUE KEY `uk_indikator_aspek_nomor` (`id_aspek`,`nomor_indikator`),
  ADD UNIQUE KEY `kode_indikator` (`kode_indikator`),
  ADD KEY `idx_indikator_aspek` (`id_aspek`);

ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id_instansi`),
  ADD UNIQUE KEY `kode_instansi` (`kode_instansi`),
  ADD KEY `fk_instansi_wilayah` (`id_wilayah`),
  ADD KEY `idx_instansi_status` (`status`);

ALTER TABLE `panduan`
  ADD PRIMARY KEY (`id_panduan`),
  ADD KEY `fk_panduan_asesor` (`id_asesor`),
  ADD KEY `fk_panduan_aspek` (`id_aspek`),
  ADD KEY `fk_panduan_indikator` (`id_indikator`),
  ADD KEY `fk_panduan_created_by` (`created_by`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`),
  ADD UNIQUE KEY `nama_role` (`nama_role`);

ALTER TABLE `tingkat_kematangan`
  ADD PRIMARY KEY (`id_tingkat`),
  ADD UNIQUE KEY `level` (`level`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_role` (`id_role`),
  ADD KEY `idx_users_instansi` (`id_instansi`);

ALTER TABLE `verifikasi_bukti`
  ADD PRIMARY KEY (`id_verifikasi`),
  ADD UNIQUE KEY `uk_verifikasi_dokumen` (`id_dokumen`),
  ADD KEY `idx_verifikasi_asesor` (`id_asesor`);

ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`id_wilayah`),
  ADD UNIQUE KEY `kode_wilayah` (`kode_wilayah`);

-- ============ AUTO_INCREMENT ============
ALTER TABLE `asesor`
  MODIFY `id_asesor` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `aspek_penilaian`
  MODIFY `id_aspek` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `audit_log`
  MODIFY `id_log` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `data_dukung`
  MODIFY `id_data_dukung` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `dokumen_bukti`
  MODIFY `id_dokumen` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `evaluasi`
  MODIFY `id_evaluasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `evaluasi_data_dukung`
  MODIFY `id_evaluasi_data_dukung` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `evaluasi_indikator`
  MODIFY `id_evaluasi_indikator` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `indikator_kriteria`
  MODIFY `id_kriteria` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `indikator_penilaian`
  MODIFY `id_indikator` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

ALTER TABLE `instansi`
  MODIFY `id_instansi` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `panduan`
  MODIFY `id_panduan` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `roles`
  MODIFY `id_role` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tingkat_kematangan`
  MODIFY `id_tingkat` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `verifikasi_bukti`
  MODIFY `id_verifikasi` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `wilayah`
  MODIFY `id_wilayah` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

-- ============ FOREIGN KEYS ============
ALTER TABLE `asesor`
  ADD CONSTRAINT `fk_asesor_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `audit_log`
  ADD CONSTRAINT `fk_audit_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `data_dukung`
  ADD CONSTRAINT `fk_data_dukung_indikator` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_penilaian` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_data_dukung_tingkat` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat_kematangan` (`id_tingkat`) ON DELETE RESTRICT;

ALTER TABLE `dokumen_bukti`
  ADD CONSTRAINT `fk_dokumen_eval_data` FOREIGN KEY (`id_evaluasi_data_dukung`) REFERENCES `evaluasi_data_dukung` (`id_evaluasi_data_dukung`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_dokumen_uploader` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `evaluasi`
  ADD CONSTRAINT `fk_evaluasi_asesor` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_evaluasi_instansi` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `evaluasi_data_dukung`
  ADD CONSTRAINT `fk_eval_data_eval_indikator` FOREIGN KEY (`id_evaluasi_indikator`) REFERENCES `evaluasi_indikator` (`id_evaluasi_indikator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eval_data_master` FOREIGN KEY (`id_data_dukung`) REFERENCES `data_dukung` (`id_data_dukung`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `evaluasi_indikator`
  ADD CONSTRAINT `fk_eval_indikator_evaluasi` FOREIGN KEY (`id_evaluasi`) REFERENCES `evaluasi` (`id_evaluasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eval_indikator_level` FOREIGN KEY (`level_kematangan`) REFERENCES `tingkat_kematangan` (`level`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eval_indikator_master` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_penilaian` (`id_indikator`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `indikator_kriteria`
  ADD CONSTRAINT `fk_kriteria_indikator` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_penilaian` (`id_indikator`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kriteria_tingkat` FOREIGN KEY (`id_tingkat`) REFERENCES `tingkat_kematangan` (`id_tingkat`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `indikator_penilaian`
  ADD CONSTRAINT `fk_indikator_aspek` FOREIGN KEY (`id_aspek`) REFERENCES `aspek_penilaian` (`id_aspek`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `instansi`
  ADD CONSTRAINT `fk_instansi_wilayah` FOREIGN KEY (`id_wilayah`) REFERENCES `wilayah` (`id_wilayah`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `panduan`
  ADD CONSTRAINT `fk_panduan_asesor` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_panduan_aspek` FOREIGN KEY (`id_aspek`) REFERENCES `aspek_penilaian` (`id_aspek`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_panduan_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_panduan_indikator` FOREIGN KEY (`id_indikator`) REFERENCES `indikator_penilaian` (`id_indikator`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_instansi` FOREIGN KEY (`id_instansi`) REFERENCES `instansi` (`id_instansi`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`) ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `verifikasi_bukti`
  ADD CONSTRAINT `fk_verifikasi_asesor` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`id_asesor`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_verifikasi_dokumen` FOREIGN KEY (`id_dokumen`) REFERENCES `dokumen_bukti` (`id_dokumen`) ON DELETE CASCADE ON UPDATE CASCADE;

SQL);
    }

    public function down(): void
    {
        DB::unprepared(<<<'SQL'
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `audit_log`;
DROP TABLE IF EXISTS `panduan`;
DROP TABLE IF EXISTS `verifikasi_bukti`;
DROP TABLE IF EXISTS `dokumen_bukti`;
DROP TABLE IF EXISTS `evaluasi_data_dukung`;
DROP TABLE IF EXISTS `evaluasi_indikator`;
DROP TABLE IF EXISTS `evaluasi`;
DROP TABLE IF EXISTS `data_dukung`;
DROP TABLE IF EXISTS `indikator_kriteria`;
DROP TABLE IF EXISTS `indikator_penilaian`;
DROP TABLE IF EXISTS `asesor`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `instansi`;
DROP TABLE IF EXISTS `aspek_penilaian`;
DROP TABLE IF EXISTS `tingkat_kematangan`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `wilayah`;
SET FOREIGN_KEY_CHECKS=1;
SQL);
    }
};
