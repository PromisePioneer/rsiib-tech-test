<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pasien'       => ['required', 'string', 'max:100'],
            'tanggal_lahir'     => ['required', 'date', 'before:today'],
            'jenis_kelamin'     => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'no_hp'             => ['required', 'string', 'max:15', 'regex:/^[0-9+\-\s]+$/'],
            'alamat'            => ['required', 'string', 'max:500'],
            'tanggal_kunjungan' => ['required', 'date'],
            'poli_tujuan'       => ['required', 'string', 'max:100'],
            'dokter'            => ['required', 'string', 'max:100'],
            'jenis_pembayaran'  => ['required', Rule::in(['Umum', 'BPJS', 'Asuransi', 'Gratis'])],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pasien.required'       => 'Nama pasien wajib diisi.',
            'tanggal_lahir.required'     => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before'       => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih.',
            'no_hp.required'             => 'No HP wajib diisi.',
            'no_hp.regex'                => 'Format no HP tidak valid.',
            'alamat.required'            => 'Alamat wajib diisi.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'poli_tujuan.required'       => 'Poli tujuan wajib diisi.',
            'dokter.required'            => 'Nama dokter wajib diisi.',
            'jenis_pembayaran.required'  => 'Jenis pembayaran wajib dipilih.',
        ];
    }
}
