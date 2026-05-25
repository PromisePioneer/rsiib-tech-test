<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'nama_pasien',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_hp',
        'alamat',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kunjungan(): HasMany
    {
        return $this->hasMany(Kunjungan::class, 'pasien_id');
    }

    public function getUmurAttribute(): int
    {
        return $this->tanggal_lahir->age;
    }
}
