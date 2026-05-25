<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsesmenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'keluhan_utama'   => ['required', 'string', 'max:1000'],
            'tekanan_darah'   => ['nullable', 'string', 'max:20', 'regex:/^\d{2,3}\/\d{2,3}$/'],
            'suhu_tubuh'      => ['nullable', 'numeric', 'min:30', 'max:45'],
            'berat_badan'     => ['nullable', 'numeric', 'min:1', 'max:300'],
            'diagnosis_awal'  => ['nullable', 'string', 'max:1000'],
            'tindakan_terapi' => ['nullable', 'string', 'max:1000'],
            'catatan_dokter'  => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'keluhan_utama.required' => 'Keluhan utama wajib diisi.',
            'tekanan_darah.regex'    => 'Format tekanan darah harus seperti: 120/80.',
            'suhu_tubuh.min'         => 'Suhu tubuh tidak valid.',
            'suhu_tubuh.max'         => 'Suhu tubuh tidak valid.',
            'berat_badan.min'        => 'Berat badan tidak valid.',
        ];
    }
}
