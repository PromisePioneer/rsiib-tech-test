# SIMRS – Aplikasi Rawat Jalan

Aplikasi pencatatan pasien rawat jalan sederhana berbasis **Laravel 12** dengan Tailwind CSS.

## Fitur

- **Pendaftaran Pasien** — form data pasien & kunjungan dalam satu halaman
- **Manajemen Kunjungan** — tambah kunjungan baru untuk pasien lama, edit, batal kunjungan
- **Asesmen Rawat Jalan** — form asesmen terhubung ke kunjungan, edit asesmen
- **Riwayat Asesmen** — tampilkan seluruh riwayat kunjungan + asesmen per pasien
- **Laporan Kunjungan** — filter berdasarkan nama, tanggal, dokter, diagnosis, status; tampilkan total kunjungan

## Teknologi

- PHP 8.3+, Laravel 12, Tailwind CSS v4 (via Vite)
- MySQL / MariaDB

## Cara Menjalankan

### 1. Clone dan install dependencies

```bash
git clone <URL_REPO> simrs-rawat-jalan
cd simrs-rawat-jalan
composer install
npm install
```

### 2. Konfigurasi environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`, sesuaikan konfigurasi database:

```
DB_DATABASE=rsiib-tech-test
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Setup database

**Opsi A — via Laravel migration (direkomendasikan):**

```bash
php artisan migrate
```

**Opsi B — import SQL langsung:**

```bash
mysql -u root -p < database/rawat_jalan.sql
```

### 4. Jalankan aplikasi

```bash
# Terminal 1 – Vite dev server
npm run dev

# Terminal 2 – Laravel
php artisan serve
```

Buka: **http://localhost:8000**

## Struktur Database

```
pasien          → data identitas pasien
  └── kunjungan → data setiap kunjungan pasien (1 pasien bisa banyak kunjungan)
       └── asesmen → data klinis per kunjungan (1 kunjungan, 1 asesmen)
```

## Alur Penggunaan

1. **Daftarkan Pasien** → tombol "Daftarkan Pasien" di halaman utama
2. **Asesmen** → klik tombol "Asesmen" pada baris pasien yang statusnya *Terdaftar*
3. **Laporan** → menu "Laporan" di navbar, gunakan filter yang tersedia
