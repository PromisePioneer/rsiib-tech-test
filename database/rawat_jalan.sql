-- ============================================================
-- SIMRS Rawat Jalan - Database Dump
-- Compatible: MySQL 5.7+ / MariaDB 10.3+
-- ============================================================

CREATE DATABASE IF NOT EXISTS `rawat_jalan` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `rawat_jalan`;

-- -----------------------------------------------
-- Tabel: pasien
-- -----------------------------------------------
CREATE TABLE IF NOT EXISTS `pasien` (
    `id`            BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `nama_pasien`   VARCHAR(100)    NOT NULL,
    `tanggal_lahir` DATE            NOT NULL,
    `jenis_kelamin` ENUM('Laki-laki','Perempuan') NOT NULL,
    `no_hp`         VARCHAR(15)     NOT NULL,
    `alamat`        TEXT            NOT NULL,
    `created_at`    TIMESTAMP       NULL DEFAULT NULL,
    `updated_at`    TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_nama_pasien`   (`nama_pasien`),
    INDEX `idx_no_hp`         (`no_hp`),
    INDEX `idx_tanggal_lahir` (`tanggal_lahir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------
-- Tabel: kunjungan
-- -----------------------------------------------
CREATE TABLE IF NOT EXISTS `kunjungan` (
    `id`                BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `pasien_id`         BIGINT UNSIGNED NOT NULL,
    `tanggal_kunjungan` DATE            NOT NULL,
    `poli_tujuan`       VARCHAR(100)    NOT NULL,
    `dokter`            VARCHAR(100)    NOT NULL,
    `jenis_pembayaran`  ENUM('Umum','BPJS','Asuransi','Gratis') NOT NULL,
    `status`            ENUM('terdaftar','sudah_asesmen','batal') NOT NULL DEFAULT 'terdaftar',
    `created_at`        TIMESTAMP       NULL DEFAULT NULL,
    `updated_at`        TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    INDEX `idx_pasien_id`           (`pasien_id`),
    INDEX `idx_tanggal_kunjungan`   (`tanggal_kunjungan`),
    INDEX `idx_dokter`              (`dokter`),
    INDEX `idx_poli_tujuan`         (`poli_tujuan`),
    INDEX `idx_status`              (`status`),
    INDEX `idx_pasien_tanggal`      (`pasien_id`, `tanggal_kunjungan`),
    INDEX `idx_poli_tanggal`        (`poli_tujuan`, `tanggal_kunjungan`),
    INDEX `idx_dokter_tanggal`      (`dokter`, `tanggal_kunjungan`),
    CONSTRAINT `fk_kunjungan_pasien` FOREIGN KEY (`pasien_id`)
        REFERENCES `pasien` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------
-- Tabel: asesmen
-- -----------------------------------------------
CREATE TABLE IF NOT EXISTS `asesmen` (
    `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `kunjungan_id`    BIGINT UNSIGNED NOT NULL,
    `keluhan_utama`   TEXT            NOT NULL,
    `tekanan_darah`   VARCHAR(20)     NULL DEFAULT NULL,
    `suhu_tubuh`      DECIMAL(4,1)    NULL DEFAULT NULL,
    `berat_badan`     DECIMAL(5,1)    NULL DEFAULT NULL,
    `diagnosis_awal`  TEXT            NULL DEFAULT NULL,
    `tindakan_terapi` TEXT            NULL DEFAULT NULL,
    `catatan_dokter`  TEXT            NULL DEFAULT NULL,
    `created_at`      TIMESTAMP       NULL DEFAULT NULL,
    `updated_at`      TIMESTAMP       NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_kunjungan_id` (`kunjungan_id`),
    INDEX `idx_kunjungan_id` (`kunjungan_id`),
    CONSTRAINT `fk_asesmen_kunjungan` FOREIGN KEY (`kunjungan_id`)
        REFERENCES `kunjungan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------
-- Sample data (opsional, untuk testing)
-- -----------------------------------------------
INSERT INTO `pasien` (`nama_pasien`, `tanggal_lahir`, `jenis_kelamin`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
('Budi Santoso',    '1985-03-12', 'Laki-laki', '081234567890', 'Jl. Merdeka No. 10, Pekanbaru', NOW(), NOW()),
('Siti Rahayu',     '1992-07-25', 'Perempuan', '082345678901', 'Jl. Sudirman No. 45, Pekanbaru', NOW(), NOW()),
('Ahmad Fauzi',     '1978-11-08', 'Laki-laki', '083456789012', 'Jl. Diponegoro No. 7, Pekanbaru', NOW(), NOW());

INSERT INTO `kunjungan` (`pasien_id`, `tanggal_kunjungan`, `poli_tujuan`, `dokter`, `jenis_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(1, '2026-05-20', 'Poli Umum',         'dr. Hendra, Sp.PD', 'BPJS',   'sudah_asesmen', NOW(), NOW()),
(2, '2026-05-22', 'Poli Kandungan',    'dr. Ratna, Sp.OG',  'Umum',   'terdaftar',     NOW(), NOW()),
(3, '2026-05-25', 'Poli Penyakit Dalam','dr. Hendra, Sp.PD','Asuransi','terdaftar',    NOW(), NOW());

INSERT INTO `asesmen` (`kunjungan_id`, `keluhan_utama`, `tekanan_darah`, `suhu_tubuh`, `berat_badan`, `diagnosis_awal`, `tindakan_terapi`, `catatan_dokter`, `created_at`, `updated_at`) VALUES
(1, 'Pasien mengeluhkan demam tinggi sejak 3 hari, disertai batuk dan pilek.', '120/80', 38.5, 70.0, 'ISPA (Infeksi Saluran Pernapasan Atas)', 'Pemberian antipiretik, antibiotik, dan antihistamin. Istirahat cukup.', 'Pasien diminta kontrol ulang dalam 3 hari jika tidak membaik.', NOW(), NOW());
