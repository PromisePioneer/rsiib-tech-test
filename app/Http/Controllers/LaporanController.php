<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $query = Kunjungan::query()
            ->with(['pasien', 'asesmen'])
            ->join('pasien', 'kunjungan.pasien_id', '=', 'pasien.id')
            ->select('kunjungan.*');

        if ($request->filled('nama_pasien')) {
            $query->where('pasien.nama_pasien', 'like', '%' . $request->nama_pasien . '%');
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('kunjungan.tanggal_kunjungan', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('kunjungan.tanggal_kunjungan', '<=', $request->tanggal_sampai);
        }

        if ($request->filled('dokter')) {
            $query->where('kunjungan.dokter', 'like', '%' . $request->dokter . '%');
        }

        if ($request->filled('diagnosis')) {
            $query->whereHas('asesmen', fn ($q) =>
                $q->where('diagnosis_awal', 'like', '%' . $request->diagnosis . '%')
            );
        }

        if ($request->filled('status')) {
            $query->where('kunjungan.status', $request->status);
        }

        $totalKunjungan = (clone $query)->count();

        $kunjungan = $query
            ->orderByDesc('kunjungan.tanggal_kunjungan')
            ->paginate(20)
            ->withQueryString();

        return view('laporan.index', compact('kunjungan', 'totalKunjungan'));
    }
}
