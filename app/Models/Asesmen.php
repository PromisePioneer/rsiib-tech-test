<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asesmen extends Model
{
    protected $table = 'asesmen';

    protected $fillable = [
        'kunjungan_id',
        'keluhan_utama',
        'tekanan_darah',
        'suhu_tubuh',
        'berat_badan',
        'diagnosis_awal',
        'tindakan_terapi',
        'catatan_dokter',
    ];

    protected $casts = [
        'suhu_tubuh'  => 'decimal:1',
        'berat_badan' => 'decimal:1',
    ];

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }
}
