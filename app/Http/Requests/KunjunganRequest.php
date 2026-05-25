<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KunjunganRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tanggal_kunjungan' => ['required', 'date'],
            'poli_tujuan'       => ['required', 'string', 'max:100'],
            'dokter'            => ['required', 'string', 'max:100'],
            'jenis_pembayaran'  => ['required', Rule::in(['Umum', 'BPJS', 'Asuransi', 'Gratis'])],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'poli_tujuan.required'       => 'Poli tujuan wajib diisi.',
            'dokter.required'            => 'Nama dokter wajib diisi.',
            'jenis_pembayaran.required'  => 'Jenis pembayaran wajib dipilih.',
        ];
    }
}
