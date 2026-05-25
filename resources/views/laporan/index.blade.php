@extends('layouts.app')

@section('title', 'Laporan Kunjungan - SIMRS')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-semibold text-gray-900">Laporan Kunjungan</h1>
        <p class="text-sm text-gray-500 mt-0.5">Data kunjungan pasien rawat jalan</p>
    </div>
</div>

{{-- Filter --}}
<form method="GET" action="{{ route('laporan.index') }}" class="bg-white rounded-xl border border-gray-200 p-5 mb-5">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Nama Pasien</label>
            <input type="text" name="nama_pasien" value="{{ request('nama_pasien') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                   placeholder="Cari nama pasien...">
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal Dari</label>
            <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Tanggal Sampai</label>
            <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Dokter</label>
            <input type="text" name="dokter" value="{{ request('dokter') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                   placeholder="Nama dokter...">
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Diagnosis</label>
            <input type="text" name="diagnosis" value="{{ request('diagnosis') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                   placeholder="Kata kunci diagnosis...">
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
            <select name="status"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                <option value="">Semua Status</option>
                <option value="terdaftar" {{ request('status') === 'terdaftar' ? 'selected' : '' }}>Terdaftar</option>
                <option value="sudah_asesmen" {{ request('status') === 'sudah_asesmen' ? 'selected' : '' }}>Sudah Asesmen</option>
                <option value="batal" {{ request('status') === 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>

    </div>

    <div class="flex items-center gap-2 mt-4">
        <button type="submit"
                class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors">
            Terapkan Filter
        </button>
        <a href="{{ route('laporan.index') }}"
           class="px-4 py-2 bg-white border border-gray-300 hover:bg-gray-50 text-gray-600 text-sm font-medium rounded-lg transition-colors">
            Reset
        </a>
    </div>
</form>

{{-- Ringkasan --}}
<div class="bg-teal-600 rounded-xl p-4 mb-5 flex items-center justify-between text-white">
    <div class="text-sm font-medium opacity-80">Total Kunjungan</div>
    <div class="text-2xl font-bold">{{ number_format($totalKunjungan) }}</div>
</div>

{{-- Tabel --}}
<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Tanggal</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama Pasien</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Poli</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Dokter</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Diagnosis Awal</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($kunjungan as $k)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                    {{ $k->tanggal_kunjungan->format('d M Y') }}
                </td>
                <td class="px-4 py-3 font-medium text-gray-900">{{ $k->pasien->nama_pasien }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $k->poli_tujuan }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $k->dokter }}</td>
                <td class="px-4 py-3 text-gray-600">
                    {{ $k->asesmen?->diagnosis_awal ?? '—' }}
                </td>
                <td class="px-4 py-3">
                    <x-badge :color="$k->status_color" :text="$k->status_label"/>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                    Tidak ada data kunjungan yang sesuai dengan filter.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($kunjungan->hasPages())
        <div class="px-4 py-3 border-t border-gray-100">
            {{ $kunjungan->links() }}
        </div>
    @endif
</div>
@endsection
