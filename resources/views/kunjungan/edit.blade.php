@extends('layouts.app')

@section('title', 'Edit Data Pasien - SIMRS')

@section('content')
<div class="mb-6">
    <a href="{{ route('kunjungan.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>
    <h1 class="text-xl font-semibold text-gray-900 mt-2">Edit Data Pasien</h1>
    <p class="text-sm text-gray-500">{{ $pasien->nama_pasien }}</p>
</div>

<form action="{{ route('kunjungan.update', $pasien) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-4">Data Pasien</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pasien <span class="text-red-500">*</span></label>
                <input type="text" name="nama_pasien" value="{{ old('nama_pasien', $pasien->nama_pasien) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('nama_pasien') border-red-400 @enderror">
                <x-form-error field="nama_pasien"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pasien->tanggal_lahir->format('Y-m-d')) }}"
                       max="{{ now()->format('Y-m-d') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('tanggal_lahir') border-red-400 @enderror">
                <x-form-error field="tanggal_lahir"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select name="jenis_kelamin"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    @foreach(['Laki-laki', 'Perempuan'] as $jk)
                        <option value="{{ $jk }}" {{ old('jenis_kelamin', $pasien->jenis_kelamin) === $jk ? 'selected' : '' }}>{{ $jk }}</option>
                    @endforeach
                </select>
                <x-form-error field="jenis_kelamin"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No HP <span class="text-red-500">*</span></label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pasien->no_hp) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('no_hp') border-red-400 @enderror">
                <x-form-error field="no_hp"/>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                <textarea name="alamat" rows="2"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent @error('alamat') border-red-400 @enderror">{{ old('alamat', $pasien->alamat) }}</textarea>
                <x-form-error field="alamat"/>
            </div>

        </div>
    </div>

    {{-- Hidden fields required by PatientRequest but not changed here --}}
    @php $kunjunganTerakhir = $pasien->kunjungan->first(); @endphp
    @if($kunjunganTerakhir)
        <input type="hidden" name="tanggal_kunjungan" value="{{ $kunjunganTerakhir->tanggal_kunjungan->format('Y-m-d') }}">
        <input type="hidden" name="poli_tujuan" value="{{ $kunjunganTerakhir->poli_tujuan }}">
        <input type="hidden" name="dokter" value="{{ $kunjunganTerakhir->dokter }}">
        <input type="hidden" name="jenis_pembayaran" value="{{ $kunjunganTerakhir->jenis_pembayaran }}">
    @else
        <input type="hidden" name="tanggal_kunjungan" value="{{ now()->format('Y-m-d') }}">
        <input type="hidden" name="poli_tujuan" value="Poli Umum">
        <input type="hidden" name="dokter" value="-">
        <input type="hidden" name="jenis_pembayaran" value="Umum">
    @endif

    <div class="flex items-center gap-3">
        <button type="submit"
                class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors">
            Simpan Perubahan
        </button>
        <a href="{{ route('kunjungan.index') }}"
           class="px-6 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 text-sm font-medium rounded-lg transition-colors">
            Batal
        </a>
    </div>

</form>
@endsection
