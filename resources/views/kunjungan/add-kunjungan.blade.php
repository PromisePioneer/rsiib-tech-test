@extends('layouts.app')

@section('title', 'Tambah Kunjungan - SIMRS')

@section('content')
<div class="mb-6">
    <a href="{{ route('kunjungan.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>
    <h1 class="text-xl font-semibold text-gray-900 mt-2">Tambah Kunjungan Baru</h1>
    <p class="text-sm text-gray-500">Pasien: <span class="font-medium text-gray-700">{{ $pasien->nama_pasien }}</span></p>
</div>

<form action="{{ route('kunjungan.store-new', $pasien) }}" method="POST" class="space-y-6">
    @csrf

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Data Kunjungan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kunjungan <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_kunjungan" value="{{ old('tanggal_kunjungan', now()->format('Y-m-d')) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('tanggal_kunjungan') border-red-400 @enderror">
                <x-form-error field="tanggal_kunjungan"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Poli Tujuan <span class="text-red-500">*</span></label>
                <input type="text" name="poli_tujuan" value="{{ old('poli_tujuan') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('poli_tujuan') border-red-400 @enderror"
                       list="poli-list" placeholder="cth: Poli Umum">
                <datalist id="poli-list">
                    <option value="Poli Umum">
                    <option value="Poli Anak">
                    <option value="Poli Kandungan">
                    <option value="Poli Penyakit Dalam">
                    <option value="Poli Jantung">
                    <option value="Poli Saraf">
                    <option value="Poli Mata">
                    <option value="Poli THT">
                    <option value="Poli Gigi">
                    <option value="Poli Kulit">
                </datalist>
                <x-form-error field="poli_tujuan"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Dokter <span class="text-red-500">*</span></label>
                <input type="text" name="dokter" value="{{ old('dokter') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('dokter') border-red-400 @enderror"
                       placeholder="Nama dokter">
                <x-form-error field="dokter"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Pembayaran <span class="text-red-500">*</span></label>
                <select name="jenis_pembayaran"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('jenis_pembayaran') border-red-400 @enderror">
                    <option value="">— Pilih —</option>
                    @foreach(['Umum', 'BPJS', 'Asuransi', 'Gratis'] as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_pembayaran') === $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                    @endforeach
                </select>
                <x-form-error field="jenis_pembayaran"/>
            </div>

        </div>
    </div>

    <div class="flex items-center gap-3">
        <button type="submit"
                class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors">
            Simpan Kunjungan
        </button>
        <a href="{{ route('kunjungan.index') }}"
           class="px-6 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors">
            Batal
        </a>
    </div>

</form>
@endsection
