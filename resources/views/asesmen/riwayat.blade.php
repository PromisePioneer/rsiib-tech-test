@extends('layouts.app')

@section('title', 'Riwayat Asesmen - SIMRS')

@section('content')
<div class="mb-6">
    <a href="{{ route('kunjungan.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>
    <h1 class="text-xl font-semibold text-gray-900 mt-2">Riwayat Asesmen</h1>
    <p class="text-sm text-gray-500">
        {{ $pasien->nama_pasien }} &middot; {{ $pasien->jenis_kelamin }}, {{ $pasien->umur }} tahun
    </p>
</div>

@if($kunjungan->isEmpty())
    <div class="bg-white rounded-xl border border-gray-200 p-12 text-center text-gray-400">
        <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
        Belum ada riwayat asesmen untuk pasien ini.
    </div>
@else
    <div class="space-y-4">
        @foreach($kunjungan as $k)
        @php $a = $k->asesmen; @endphp
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-3 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center gap-4 text-sm">
                    <span class="font-semibold text-gray-900">{{ $k->tanggal_kunjungan->format('d M Y') }}</span>
                    <span class="text-gray-500">{{ $k->poli_tujuan }}</span>
                    <span class="text-gray-500">{{ $k->dokter }}</span>
                    <x-badge :color="$k->status_color" :text="$k->status_label"/>
                </div>
                <a href="{{ route('asesmen.edit', $k) }}"
                   class="text-xs text-teal-600 hover:text-teal-700 font-medium">Edit</a>
            </div>
            <div class="px-5 py-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Keluhan Utama</div>
                    <div class="text-gray-800">{{ $a->keluhan_utama }}</div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Tekanan Darah</div>
                        <div class="text-gray-800">{{ $a->tekanan_darah ?? '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Suhu</div>
                        <div class="text-gray-800">{{ $a->suhu_tubuh ? $a->suhu_tubuh . ' °C' : '—' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-semibold text-gray-400 uppercase mb-1">BB</div>
                        <div class="text-gray-800">{{ $a->berat_badan ? $a->berat_badan . ' kg' : '—' }}</div>
                    </div>
                </div>
                @if($a->diagnosis_awal)
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Diagnosis Awal</div>
                    <div class="text-gray-800">{{ $a->diagnosis_awal }}</div>
                </div>
                @endif
                @if($a->tindakan_terapi)
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Tindakan / Terapi</div>
                    <div class="text-gray-800">{{ $a->tindakan_terapi }}</div>
                </div>
                @endif
                @if($a->catatan_dokter)
                <div class="md:col-span-2">
                    <div class="text-xs font-semibold text-gray-400 uppercase mb-1">Catatan Dokter</div>
                    <div class="text-gray-800">{{ $a->catatan_dokter }}</div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
