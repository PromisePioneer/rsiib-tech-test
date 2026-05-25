@extends('layouts.app')

@section('title', 'Daftar Pasien - SIMRS')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-semibold text-gray-900">Pendaftaran Pasien Rawat Jalan</h1>
        <p class="text-sm text-gray-500 mt-0.5">Kelola data pasien dan kunjungan</p>
    </div>
    <a href="{{ route('kunjungan.create') }}"
       class="inline-flex items-center gap-1.5 px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-medium rounded-lg transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Daftarkan Pasien
    </a>
</div>

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama Pasien</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Kelamin / Usia</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">No HP</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Kunjungan Terakhir</th>
                <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</th>
                <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wide">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pasien as $p)
            @php $kunjunganTerakhir = $p->kunjungan->first(); @endphp
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-4 py-3">
                    <div class="font-medium text-gray-900">{{ $p->nama_pasien }}</div>
                    <div class="text-xs text-gray-400 truncate max-w-[180px]">{{ $p->alamat }}</div>
                </td>
                <td class="px-4 py-3 text-gray-600">
                    {{ $p->jenis_kelamin }}, {{ $p->umur }} th
                </td>
                <td class="px-4 py-3 text-gray-600">{{ $p->no_hp }}</td>
                <td class="px-4 py-3 text-gray-600">
                    @if($kunjunganTerakhir)
                        <div>{{ $kunjunganTerakhir->tanggal_kunjungan->format('d M Y') }}</div>
                        <div class="text-xs text-gray-400">{{ $kunjunganTerakhir->poli_tujuan }} — {{ $kunjunganTerakhir->dokter }}</div>
                    @else
                        <span class="text-gray-400">—</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    @if($kunjunganTerakhir)
                        <x-badge :color="$kunjunganTerakhir->status_color" :text="$kunjunganTerakhir->status_label"/>
                    @else
                        <span class="text-gray-400 text-xs">—</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center justify-end gap-2">
                        @if($kunjunganTerakhir && $kunjunganTerakhir->status === 'terdaftar')
                            <a href="{{ route('asesmen.create', $kunjunganTerakhir) }}"
                               class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-green-700 bg-green-50 hover:bg-green-100 rounded-md transition-colors">
                               Asesmen
                            </a>
                        @elseif($kunjunganTerakhir && $kunjunganTerakhir->status === 'sudah_asesmen')
                            <a href="{{ route('asesmen.edit', $kunjunganTerakhir) }}"
                               class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-md transition-colors">
                               Edit Asesmen
                            </a>
                        @endif

                        {{-- Riwayat --}}
                        <a href="{{ route('asesmen.riwayat', $p) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
                           Riwayat
                        </a>

                        {{-- Kunjungan baru --}}
                        <a href="{{ route('kunjungan.add', $p) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-teal-700 bg-teal-50 hover:bg-teal-100 rounded-md transition-colors">
                           + Kunjungan
                        </a>

                        {{-- Edit pasien --}}
                        <a href="{{ route('kunjungan.edit', $p) }}"
                           class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md transition-colors">
                           Edit
                        </a>

                        {{-- Batal kunjungan --}}
                        @if($kunjunganTerakhir && $kunjunganTerakhir->status !== 'batal')
                            <form action="{{ route('kunjungan.destroy', $kunjunganTerakhir) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin membatalkan kunjungan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition-colors">
                                    Batal
                                </button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-4 py-12 text-center text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Belum ada data pasien terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($pasien->hasPages())
        <div class="px-4 py-3 border-t border-gray-100">
            {{ $pasien->links() }}
        </div>
    @endif
</div>
@endsection
