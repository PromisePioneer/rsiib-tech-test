<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsesmenRequest;
use App\Models\Asesmen;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AsesmenController extends Controller
{
    public function create(Kunjungan $kunjungan): View
    {
        $kunjungan->load('pasien');

        return view('asesmen.create', compact('kunjungan'));
    }

    public function store(AsesmenRequest $request, Kunjungan $kunjungan): RedirectResponse
    {
        $kunjungan->asesmen()->create($request->validated());

        $kunjungan->update(['status' => 'sudah_asesmen']);

        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Asesmen berhasil disimpan.');
    }

    public function edit(Kunjungan $kunjungan): View
    {
        $kunjungan->load(['pasien', 'asesmen']);

        return view('asesmen.edit', compact('kunjungan'));
    }

    public function update(AsesmenRequest $request, Kunjungan $kunjungan): RedirectResponse
    {
        $kunjungan->asesmen->update($request->validated());

        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Asesmen berhasil diperbarui.');
    }

    public function riwayat(Pasien $pasien): View
    {
        $kunjungan = $pasien->kunjungan()
            ->with('asesmen')
            ->whereHas('asesmen')
            ->latest('tanggal_kunjungan')
            ->get();

        return view('asesmen.riwayat', compact('pasien', 'kunjungan'));
    }
}
