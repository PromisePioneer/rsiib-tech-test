-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rsib_tech_test
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asesmen`
--

DROP TABLE IF EXISTS `asesmen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asesmen` (
                           `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                           `kunjungan_id` bigint unsigned NOT NULL,
                           `keluhan_utama` text COLLATE utf8mb4_unicode_ci NOT NULL,
                           `tekanan_darah` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `suhu_tubuh` decimal(4,1) DEFAULT NULL,
                           `berat_badan` decimal(5,1) DEFAULT NULL,
                           `diagnosis_awal` text COLLATE utf8mb4_unicode_ci,
                           `tindakan_terapi` text COLLATE utf8mb4_unicode_ci,
                           `catatan_dokter` text COLLATE utf8mb4_unicode_ci,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           UNIQUE KEY `asesmen_kunjungan_id_unique` (`kunjungan_id`),
                           KEY `asesmen_kunjungan_id_index` (`kunjungan_id`),
                           CONSTRAINT `asesmen_kunjungan_id_foreign` FOREIGN KEY (`kunjungan_id`) REFERENCES `kunjungan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesmen`
--

LOCK TABLES `asesmen` WRITE;
/*!40000 ALTER TABLE `asesmen` DISABLE KEYS */;
INSERT INTO `asesmen` VALUES (1,1,'Pasien mengeluhkan demam tinggi sejak 3 hari, disertai nyeri kepala dan lemas.','130/85',38.7,72.0,'Demam Tifoid (Typhoid Fever)','Pemberian antibiotik ciprofloxacin 500mg 2x/hari, antipiretik paracetamol, dan cairan oral. Anjuran bed rest.','Pasien diminta kontrol ulang setelah 5 hari. Hindari makanan pedas dan berminyak.','2026-05-24 21:15:05','2026-05-24 21:15:05'),(2,2,'Kontrol ulang typhoid. Demam sudah turun, namun masih terasa lemas.','120/80',37.2,71.5,'Typhoid Fever dalam perbaikan','Lanjut antibiotik 5 hari ke depan. Tambah suplemen vitamin B-kompleks.','Kondisi membaik. Pasien boleh beraktivitas ringan.','2026-05-24 21:15:05','2026-05-24 21:15:05'),(3,4,'Mual dan muntah pada pagi hari, usia kehamilan 8 minggu.','110/70',36.8,58.0,'Hiperemesis Gravidarum ringan','Pemberian antiemetik metoclopramide, vitamin B6. Anjuran makan sedikit tapi sering.','USG janin dalam kondisi normal. Pasien dianjurkan untuk banyak minum dan istirahat cukup.','2026-05-24 21:15:05','2026-05-24 21:15:05'),(4,6,'Nyeri dada sebelah kiri saat beraktivitas, disertai sesak napas.','150/95',36.5,82.0,'Angina Pektoris Stabil','Pemberian nitrat sublingual, beta-blocker. Rujukan untuk EKG dan ekokardiografi.','Pasien dianjurkan mengurangi aktivitas berat dan menghindari stres. Kontrol tekanan darah secara rutin.','2026-05-24 21:15:05','2026-05-24 21:15:05'),(5,7,'Kontrol rutin jantung. Nyeri dada berkurang setelah minum obat.','140/90',36.6,81.5,'Hipertensi + Angina Pektoris dalam terapi','Lanjut beta-blocker, tambah amlodipine 5mg. Diet rendah garam.','Hasil EKG menunjukkan perbaikan. Jadwalkan kontrol 1 bulan lagi.','2026-05-24 21:15:05','2026-05-24 21:15:05'),(6,9,'Bintik-bintik merah pada wajah dan lengan sejak 2 minggu, terasa gatal.','110/70',36.7,54.0,'Urtikaria (Biduran) Kronik','Antihistamin cetirizine 10mg 1x/malam. Krim hidrokortison topikal tipis. Hindari pemicu alergi.','Pasien disarankan mengidentifikasi pemicu alergi (makanan, sabun, deterjen). Kembali jika belum membaik dalam 2 minggu.','2026-05-24 21:15:05','2026-05-24 21:15:05'),(7,10,'Nyeri kepala berdenyut sebelah kanan sejak seminggu, mual, sensitif terhadap cahaya.','125/82',36.9,78.0,'Migrain tanpa aura','Sumatriptan 50mg saat serangan. Propranolol 40mg sebagai profilaksis. Hindari pemicu (kopi, stres, kurang tidur).','Pasien diminta mencatat frekuensi dan durasi nyeri kepala dalam buku harian.','2026-05-24 21:15:05','2026-05-24 21:15:05');
/*!40000 ALTER TABLE `asesmen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
                         `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
                         `expiration` bigint NOT NULL,
                         PRIMARY KEY (`key`),
                         KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
                               `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `expiration` bigint NOT NULL,
                               PRIMARY KEY (`key`),
                               KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
                               `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                               `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
                               KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
                               `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `total_jobs` int NOT NULL,
                               `pending_jobs` int NOT NULL,
                               `failed_jobs` int NOT NULL,
                               `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                               `options` mediumtext COLLATE utf8mb4_unicode_ci,
                               `cancelled_at` int DEFAULT NULL,
                               `created_at` int NOT NULL,
                               `finished_at` int DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
                        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                        `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                        `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                        `attempts` smallint unsigned NOT NULL,
                        `reserved_at` int unsigned DEFAULT NULL,
                        `available_at` int unsigned NOT NULL,
                        `created_at` int unsigned NOT NULL,
                        PRIMARY KEY (`id`),
                        KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kunjungan`
--

DROP TABLE IF EXISTS `kunjungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kunjungan` (
                             `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                             `pasien_id` bigint unsigned NOT NULL,
                             `tanggal_kunjungan` date NOT NULL,
                             `poli_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `dokter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `jenis_pembayaran` enum('Umum','BPJS','Asuransi','Gratis') COLLATE utf8mb4_unicode_ci NOT NULL,
                             `status` enum('terdaftar','sudah_asesmen','batal') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'terdaftar',
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`),
                             KEY `kunjungan_pasien_id_index` (`pasien_id`),
                             KEY `kunjungan_tanggal_kunjungan_index` (`tanggal_kunjungan`),
                             KEY `kunjungan_dokter_index` (`dokter`),
                             KEY `kunjungan_poli_tujuan_index` (`poli_tujuan`),
                             KEY `kunjungan_status_index` (`status`),
                             KEY `kunjungan_pasien_id_tanggal_kunjungan_index` (`pasien_id`,`tanggal_kunjungan`),
                             KEY `kunjungan_poli_tujuan_tanggal_kunjungan_index` (`poli_tujuan`,`tanggal_kunjungan`),
                             KEY `kunjungan_dokter_tanggal_kunjungan_index` (`dokter`,`tanggal_kunjungan`),
                             CONSTRAINT `kunjungan_pasien_id_foreign` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kunjungan`
--

LOCK TABLES `kunjungan` WRITE;
/*!40000 ALTER TABLE `kunjungan` DISABLE KEYS */;
INSERT INTO `kunjungan` VALUES (1,1,'2026-05-10','Poli Penyakit Dalam','dr. Hendra Wijaya, Sp.PD','BPJS','sudah_asesmen','2026-05-24 21:15:05','2026-05-24 21:15:05'),(2,1,'2026-05-20','Poli Penyakit Dalam','dr. Hendra Wijaya, Sp.PD','BPJS','sudah_asesmen','2026-05-24 21:15:05','2026-05-24 21:15:05'),(3,1,'2026-05-25','Poli Umum','dr. Sari Dewi','BPJS','terdaftar','2026-05-24 21:15:05','2026-05-24 21:15:05'),(4,2,'2026-05-15','Poli Kandungan','dr. Ratna Sari, Sp.OG','Umum','sudah_asesmen','2026-05-24 21:15:05','2026-05-24 21:15:05'),(5,2,'2026-05-22','Poli Kandungan','dr. Ratna Sari, Sp.OG','Umum','terdaftar','2026-05-24 21:15:05','2026-05-24 21:15:05'),(6,3,'2026-04-10','Poli Jantung','dr. Bima Sakti, Sp.JP','Asuransi','sudah_asesmen','2026-05-24 21:15:05','2026-05-24 21:15:05'),(7,3,'2026-05-05','Poli Jantung','dr. Bima Sakti, Sp.JP','Asuransi','sudah_asesmen','2026-05-24 21:15:05','2026-05-24 21:15:05'),(8,3,'2026-05-25','Poli Jantung','dr. Bima Sakti, Sp.JP','Asuransi','terdaftar','2026-05-24 21:15:05','2026-05-24 21:15:05'),(9,4,'2026-05-23','Poli Kulit','dr. Maya Putri, Sp.KK','BPJS','sudah_asesmen','2026-05-24 21:15:05','2026-05-24 21:15:05'),(10,5,'2026-05-18','Poli Saraf','dr. Andri Susanto, Sp.S','Umum','sudah_asesmen','2026-05-24 21:15:05','2026-05-24 21:15:05'),(11,5,'2026-05-24','Poli Saraf','dr. Andri Susanto, Sp.S','Umum','batal','2026-05-24 21:15:06','2026-05-24 21:15:06'),(12,6,'2026-05-25','Poli Umum','dr. Sari Dewi','BPJS','terdaftar','2026-05-24 21:15:06','2026-05-24 21:15:06');
/*!40000 ALTER TABLE `kunjungan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_25_025710_create_pasien_table',1),(5,'2026_05_25_025724_create_kunjungan_table',1),(6,'2026_05_25_025738_create_asesmen_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasien`
--

DROP TABLE IF EXISTS `pasien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pasien` (
                          `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                          `nama_pasien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `tanggal_lahir` date NOT NULL,
                          `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci NOT NULL,
                          `no_hp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          KEY `pasien_nama_pasien_index` (`nama_pasien`),
                          KEY `pasien_no_hp_index` (`no_hp`),
                          KEY `pasien_tanggal_lahir_index` (`tanggal_lahir`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasien`
--

LOCK TABLES `pasien` WRITE;
/*!40000 ALTER TABLE `pasien` DISABLE KEYS */;
INSERT INTO `pasien` VALUES (1,'Budi Santoso','1985-03-12','Laki-laki','081234567890','Jl. Merdeka No. 10, Pekanbaru','2026-05-24 21:15:05','2026-05-24 21:15:05'),(2,'Siti Rahayu','1992-07-25','Perempuan','082345678901','Jl. Sudirman No. 45, Pekanbaru','2026-05-24 21:15:05','2026-05-24 21:15:05'),(3,'Ahmad Fauzi','1978-11-08','Laki-laki','083456789012','Jl. Diponegoro No. 7, Pekanbaru','2026-05-24 21:15:05','2026-05-24 21:15:05'),(4,'Dewi Anggraini','2000-05-14','Perempuan','089876543210','Jl. Ahmad Yani No. 88, Pekanbaru','2026-05-24 21:15:05','2026-05-24 21:15:05'),(5,'Rudi Hermawan','1965-09-30','Laki-laki','081122334455','Jl. Pahlawan No. 21, Pekanbaru','2026-05-24 21:15:05','2026-05-24 21:15:05'),(6,'Nurul Hidayah','1990-01-17','Perempuan','085611223344','Jl. Kartini No. 5, Pekanbaru','2026-05-24 21:15:06','2026-05-24 21:15:06');
/*!40000 ALTER TABLE `pasien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
                                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL,
                                         PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
                            `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `user_id` bigint unsigned DEFAULT NULL,
                            `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `user_agent` text COLLATE utf8mb4_unicode_ci,
                            `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
                            `last_activity` int NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `sessions_user_id_index` (`user_id`),
                            KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('rkOExr6drb0Sy3oGjcvFyfLWPTjVQr63CfkHG6TJ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiI0M3pXaXl2djdLMEo5SW9RSllYRU1Id2F0aVZjcHRpRVdGbkIwVDdSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9rdW5qdW5nYW4iLCJyb3V0ZSI6Imt1bmp1bmdhbi5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1779683759);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-25 11:39:13
