@extends('layouts.app')

@section('title', 'Form Asesmen - SIMRS')

@section('content')
<div class="mb-6">
    <a href="{{ route('kunjungan.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>
    <h1 class="text-xl font-semibold text-gray-900 mt-2">Form Asesmen Rawat Jalan</h1>
</div>

{{-- Info pasien --}}
<div class="bg-teal-50 border border-teal-200 rounded-xl p-4 mb-6 grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
    <div>
        <div class="text-xs text-teal-600 font-medium uppercase">Pasien</div>
        <div class="font-semibold text-gray-900">{{ $kunjungan->pasien->nama_pasien }}</div>
    </div>
    <div>
        <div class="text-xs text-teal-600 font-medium uppercase">Tgl Kunjungan</div>
        <div class="font-medium text-gray-800">{{ $kunjungan->tanggal_kunjungan->format('d M Y') }}</div>
    </div>
    <div>
        <div class="text-xs text-teal-600 font-medium uppercase">Poli</div>
        <div class="font-medium text-gray-800">{{ $kunjungan->poli_tujuan }}</div>
    </div>
    <div>
        <div class="text-xs text-teal-600 font-medium uppercase">Dokter</div>
        <div class="font-medium text-gray-800">{{ $kunjungan->dokter }}</div>
    </div>
</div>

<form action="{{ route('asesmen.store', $kunjungan) }}" method="POST" class="space-y-6">
    @csrf

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Data Asesmen</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Keluhan Utama <span class="text-red-500">*</span></label>
                <textarea name="keluhan_utama" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('keluhan_utama') border-red-400 @enderror"
                          placeholder="Deskripsikan keluhan utama pasien">{{ old('keluhan_utama') }}</textarea>
                <x-form-error field="keluhan_utama"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tekanan Darah</label>
                <input type="text" name="tekanan_darah" value="{{ old('tekanan_darah') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('tekanan_darah') border-red-400 @enderror"
                       placeholder="120/80">
                <x-form-error field="tekanan_darah"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Suhu Tubuh (°C)</label>
                <input type="number" name="suhu_tubuh" value="{{ old('suhu_tubuh') }}"
                       step="0.1" min="30" max="45"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('suhu_tubuh') border-red-400 @enderror"
                       placeholder="36.5">
                <x-form-error field="suhu_tubuh"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Berat Badan (kg)</label>
                <input type="number" name="berat_badan" value="{{ old('berat_badan') }}"
                       step="0.1" min="1" max="300"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('berat_badan') border-red-400 @enderror"
                       placeholder="60.0">
                <x-form-error field="berat_badan"/>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Diagnosis Awal</label>
                <textarea name="diagnosis_awal" rows="2"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('diagnosis_awal') border-red-400 @enderror"
                          placeholder="Diagnosis awal dokter">{{ old('diagnosis_awal') }}</textarea>
                <x-form-error field="diagnosis_awal"/>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tindakan / Terapi</label>
                <textarea name="tindakan_terapi" rows="2"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('tindakan_terapi') border-red-400 @enderror"
                          placeholder="Tindakan atau terapi yang diberikan">{{ old('tindakan_terapi') }}</textarea>
                <x-form-error field="tindakan_terapi"/>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Dokter</label>
                <textarea name="catatan_dokter" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('catatan_dokter') border-red-400 @enderror"
                          placeholder="Catatan tambahan dari dokter">{{ old('catatan_dokter') }}</textarea>
                <x-form-error field="catatan_dokter"/>
            </div>

        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit"
                class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors">
            Simpan Asesmen
        </button>
        <a href="{{ route('kunjungan.index') }}"
           class="px-6 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors">
            Batal
        </a>
    </div>

</form>
@endsection
