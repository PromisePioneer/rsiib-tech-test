<?php

namespace Database\Seeders;

use App\Models\Asesmen;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Data dummy pasien rawat jalan beserta kunjungan dan asesmen.
     */
    public function run(): void
    {
        $records = $this->data();

        foreach ($records as $record) {
            $pasien = Pasien::create($record['pasien']);

            foreach ($record['kunjungan'] as $kunjunganData) {
                $asesmen = $kunjunganData['asesmen'] ?? null;
                unset($kunjunganData['asesmen']);

                $kunjungan = $pasien->kunjungan()->create($kunjunganData);

                if ($asesmen) {
                    $kunjungan->asesmen()->create($asesmen);
                    $kunjungan->update(['status' => 'sudah_asesmen']);
                }
            }
        }
    }

    private function data(): array
    {
        return [
            [
                'pasien' => [
                    'nama_pasien'   => 'Budi Santoso',
                    'tanggal_lahir' => '1985-03-12',
                    'jenis_kelamin' => 'Laki-laki',
                    'no_hp'         => '081234567890',
                    'alamat'        => 'Jl. Merdeka No. 10, Pekanbaru',
                ],
                'kunjungan' => [
                    [
                        'tanggal_kunjungan' => '2026-05-10',
                        'poli_tujuan'       => 'Poli Penyakit Dalam',
                        'dokter'            => 'dr. Hendra Wijaya, Sp.PD',
                        'jenis_pembayaran'  => 'BPJS',
                        'status'            => 'terdaftar',
                        'asesmen'           => [
                            'keluhan_utama'   => 'Pasien mengeluhkan demam tinggi sejak 3 hari, disertai nyeri kepala dan lemas.',
                            'tekanan_darah'   => '130/85',
                            'suhu_tubuh'      => 38.7,
                            'berat_badan'     => 72.0,
                            'diagnosis_awal'  => 'Demam Tifoid (Typhoid Fever)',
                            'tindakan_terapi' => 'Pemberian antibiotik ciprofloxacin 500mg 2x/hari, antipiretik paracetamol, dan cairan oral. Anjuran bed rest.',
                            'catatan_dokter'  => 'Pasien diminta kontrol ulang setelah 5 hari. Hindari makanan pedas dan berminyak.',
                        ],
                    ],
                    [
                        'tanggal_kunjungan' => '2026-05-20',
                        'poli_tujuan'       => 'Poli Penyakit Dalam',
                        'dokter'            => 'dr. Hendra Wijaya, Sp.PD',
                        'jenis_pembayaran'  => 'BPJS',
                        'status'            => 'terdaftar',
                        'asesmen'           => [
                            'keluhan_utama'   => 'Kontrol ulang typhoid. Demam sudah turun, namun masih terasa lemas.',
                            'tekanan_darah'   => '120/80',
                            'suhu_tubuh'      => 37.2,
                            'berat_badan'     => 71.5,
                            'diagnosis_awal'  => 'Typhoid Fever dalam perbaikan',
                            'tindakan_terapi' => 'Lanjut antibiotik 5 hari ke depan. Tambah suplemen vitamin B-kompleks.',
                            'catatan_dokter'  => 'Kondisi membaik. Pasien boleh beraktivitas ringan.',
                        ],
                    ],
                    [
                        'tanggal_kunjungan' => '2026-05-25',
                        'poli_tujuan'       => 'Poli Umum',
                        'dokter'            => 'dr. Sari Dewi',
                        'jenis_pembayaran'  => 'BPJS',
                        'status'            => 'terdaftar',
                    ],
                ],
            ],

            [
                'pasien' => [
                    'nama_pasien'   => 'Siti Rahayu',
                    'tanggal_lahir' => '1992-07-25',
                    'jenis_kelamin' => 'Perempuan',
                    'no_hp'         => '082345678901',
                    'alamat'        => 'Jl. Sudirman No. 45, Pekanbaru',
                ],
                'kunjungan' => [
                    [
                        'tanggal_kunjungan' => '2026-05-15',
                        'poli_tujuan'       => 'Poli Kandungan',
                        'dokter'            => 'dr. Ratna Sari, Sp.OG',
                        'jenis_pembayaran'  => 'Umum',
                        'status'            => 'terdaftar',
                        'asesmen'           => [
                            'keluhan_utama'   => 'Mual dan muntah pada pagi hari, usia kehamilan 8 minggu.',
                            'tekanan_darah'   => '110/70',
                            'suhu_tubuh'      => 36.8,
                            'berat_badan'     => 58.0,
                            'diagnosis_awal'  => 'Hiperemesis Gravidarum ringan',
                            'tindakan_terapi' => 'Pemberian antiemetik metoclopramide, vitamin B6. Anjuran makan sedikit tapi sering.',
                            'catatan_dokter'  => 'USG janin dalam kondisi normal. Pasien dianjurkan untuk banyak minum dan istirahat cukup.',
                        ],
                    ],
                    [
                        'tanggal_kunjungan' => '2026-05-22',
                        'poli_tujuan'       => 'Poli Kandungan',
                        'dokter'            => 'dr. Ratna Sari, Sp.OG',
                        'jenis_pembayaran'  => 'Umum',
                        'status'            => 'terdaftar',
                    ],
                ],
            ],

            [
                'pasien' => [
                    'nama_pasien'   => 'Ahmad Fauzi',
                    'tanggal_lahir' => '1978-11-08',
                    'jenis_kelamin' => 'Laki-laki',
                    'no_hp'         => '083456789012',
                    'alamat'        => 'Jl. Diponegoro No. 7, Pekanbaru',
                ],
                'kunjungan' => [
                    [
                        'tanggal_kunjungan' => '2026-04-10',
                        'poli_tujuan'       => 'Poli Jantung',
                        'dokter'            => 'dr. Bima Sakti, Sp.JP',
                        'jenis_pembayaran'  => 'Asuransi',
                        'status'            => 'terdaftar',
                        'asesmen'           => [
                            'keluhan_utama'   => 'Nyeri dada sebelah kiri saat beraktivitas, disertai sesak napas.',
                            'tekanan_darah'   => '150/95',
                            'suhu_tubuh'      => 36.5,
                            'berat_badan'     => 82.0,
                            'diagnosis_awal'  => 'Angina Pektoris Stabil',
                            'tindakan_terapi' => 'Pemberian nitrat sublingual, beta-blocker. Rujukan untuk EKG dan ekokardiografi.',
                            'catatan_dokter'  => 'Pasien dianjurkan mengurangi aktivitas berat dan menghindari stres. Kontrol tekanan darah secara rutin.',
                        ],
                    ],
                    [
                        'tanggal_kunjungan' => '2026-05-05',
                        'poli_tujuan'       => 'Poli Jantung',
                        'dokter'            => 'dr. Bima Sakti, Sp.JP',
                        'jenis_pembayaran'  => 'Asuransi',
                        'status'            => 'terdaftar',
                        'asesmen'           => [
                            'keluhan_utama'   => 'Kontrol rutin jantung. Nyeri dada berkurang setelah minum obat.',
                            'tekanan_darah'   => '140/90',
                            'suhu_tubuh'      => 36.6,
                            'berat_badan'     => 81.5,
                            'diagnosis_awal'  => 'Hipertensi + Angina Pektoris dalam terapi',
                            'tindakan_terapi' => 'Lanjut beta-blocker, tambah amlodipine 5mg. Diet rendah garam.',
                            'catatan_dokter'  => 'Hasil EKG menunjukkan perbaikan. Jadwalkan kontrol 1 bulan lagi.',
                        ],
                    ],
                    [
                        'tanggal_kunjungan' => '2026-05-25',
                        'poli_tujuan'       => 'Poli Jantung',
                        'dokter'            => 'dr. Bima Sakti, Sp.JP',
                        'jenis_pembayaran'  => 'Asuransi',
                        'status'            => 'terdaftar',
                    ],
                ],
            ],

            [
                'pasien' => [
                    'nama_pasien'   => 'Dewi Anggraini',
                    'tanggal_lahir' => '2000-05-14',
                    'jenis_kelamin' => 'Perempuan',
                    'no_hp'         => '089876543210',
                    'alamat'        => 'Jl. Ahmad Yani No. 88, Pekanbaru',
                ],
                'kunjungan' => [
                    [
                        'tanggal_kunjungan' => '2026-05-23',
                        'poli_tujuan'       => 'Poli Kulit',
                        'dokter'            => 'dr. Maya Putri, Sp.KK',
                        'jenis_pembayaran'  => 'BPJS',
                        'status'            => 'terdaftar',
                        'asesmen'           => [
                            'keluhan_utama'   => 'Bintik-bintik merah pada wajah dan lengan sejak 2 minggu, terasa gatal.',
                            'tekanan_darah'   => '110/70',
                            'suhu_tubuh'      => 36.7,
                            'berat_badan'     => 54.0,
                            'diagnosis_awal'  => 'Urtikaria (Biduran) Kronik',
                            'tindakan_terapi' => 'Antihistamin cetirizine 10mg 1x/malam. Krim hidrokortison topikal tipis. Hindari pemicu alergi.',
                            'catatan_dokter'  => 'Pasien disarankan mengidentifikasi pemicu alergi (makanan, sabun, deterjen). Kembali jika belum membaik dalam 2 minggu.',
                        ],
                    ],
                ],
            ],

            [
                'pasien' => [
                    'nama_pasien'   => 'Rudi Hermawan',
                    'tanggal_lahir' => '1965-09-30',
                    'jenis_kelamin' => 'Laki-laki',
                    'no_hp'         => '081122334455',
                    'alamat'        => 'Jl. Pahlawan No. 21, Pekanbaru',
                ],
                'kunjungan' => [
                    [
                        'tanggal_kunjungan' => '2026-05-18',
                        'poli_tujuan'       => 'Poli Saraf',
                        'dokter'            => 'dr. Andri Susanto, Sp.S',
                        'jenis_pembayaran'  => 'Umum',
                        'status'            => 'terdaftar',
                        'asesmen'           => [
                            'keluhan_utama'   => 'Nyeri kepala berdenyut sebelah kanan sejak seminggu, mual, sensitif terhadap cahaya.',
                            'tekanan_darah'   => '125/82',
                            'suhu_tubuh'      => 36.9,
                            'berat_badan'     => 78.0,
                            'diagnosis_awal'  => 'Migrain tanpa aura',
                            'tindakan_terapi' => 'Sumatriptan 50mg saat serangan. Propranolol 40mg sebagai profilaksis. Hindari pemicu (kopi, stres, kurang tidur).',
                            'catatan_dokter'  => 'Pasien diminta mencatat frekuensi dan durasi nyeri kepala dalam buku harian.',
                        ],
                    ],
                    [
                        'tanggal_kunjungan' => '2026-05-24',
                        'poli_tujuan'       => 'Poli Saraf',
                        'dokter'            => 'dr. Andri Susanto, Sp.S',
                        'jenis_pembayaran'  => 'Umum',
                        'status'            => 'batal',
                    ],
                ],
            ],

            [
                'pasien' => [
                    'nama_pasien'   => 'Nurul Hidayah',
                    'tanggal_lahir' => '1990-01-17',
                    'jenis_kelamin' => 'Perempuan',
                    'no_hp'         => '085611223344',
                    'alamat'        => 'Jl. Kartini No. 5, Pekanbaru',
                ],
                'kunjungan' => [
                    [
                        'tanggal_kunjungan' => '2026-05-25',
                        'poli_tujuan'       => 'Poli Umum',
                        'dokter'            => 'dr. Sari Dewi',
                        'jenis_pembayaran'  => 'BPJS',
                        'status'            => 'terdaftar',
                    ],
                ],
            ],
        ];
    }
}
