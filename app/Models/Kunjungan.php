<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kunjungan extends Model
{
    protected $table = 'kunjungan';

    protected $fillable = [
        'pasien_id',
        'tanggal_kunjungan',
        'poli_tujuan',
        'dokter',
        'jenis_pembayaran',
        'status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function asesmen(): HasOne
    {
        return $this->hasOne(Asesmen::class, 'kunjungan_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'terdaftar'      => 'Terdaftar',
            'sudah_asesmen'  => 'Sudah Asesmen',
            'batal'          => 'Batal',
            default          => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'terdaftar'      => 'blue',
            'sudah_asesmen'  => 'green',
            'batal'          => 'red',
            default          => 'gray',
        };
    }
}
