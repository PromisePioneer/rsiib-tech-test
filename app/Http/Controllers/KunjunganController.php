<?php

namespace App\Http\Controllers;

use App\Http\Requests\KunjunganRequest;
use App\Http\Requests\PatientRequest;
use App\Models\Kunjungan;
use App\Models\Pasien;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KunjunganController extends Controller
{
    public function index(): View
    {
        $pasien = Pasien::query()
            ->with(['kunjungan' => fn ($q) => $q->latest()])
            ->orderBy('nama_pasien')
            ->paginate(15);

        return view('kunjungan.index', compact('pasien'));
    }

    public function create(): View
    {
        return view('kunjungan.create');
    }

    public function store(PatientRequest $request): RedirectResponse
    {
        $pasien = Pasien::create($request->validated());

        $pasien->kunjungan()->create([
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'poli_tujuan'       => $request->poli_tujuan,
            'dokter'            => $request->dokter,
            'jenis_pembayaran'  => $request->jenis_pembayaran,
            'status'            => 'terdaftar',
        ]);

        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Pasien berhasil didaftarkan.');
    }

    public function edit(Pasien $pasien): View
    {
        $pasien->load(['kunjungan' => fn ($q) => $q->latest()]);

        return view('kunjungan.edit', compact('pasien'));
    }

    public function update(PatientRequest $request, Pasien $pasien): RedirectResponse
    {
        $pasien->update($request->only([
            'nama_pasien', 'tanggal_lahir', 'jenis_kelamin', 'no_hp', 'alamat',
        ]));

        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Kunjungan $kunjungan): RedirectResponse
    {
        $kunjungan->update(['status' => 'batal']);

        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Kunjungan berhasil dibatalkan.');
    }

    public function addKunjungan(Pasien $pasien): View
    {
        return view('kunjungan.add-kunjungan', compact('pasien'));
    }

    public function storeKunjungan(KunjunganRequest $request, Pasien $pasien): RedirectResponse
    {
        $pasien->kunjungan()->create(
            array_merge($request->validated(), ['status' => 'terdaftar'])
        );

        return redirect()
            ->route('kunjungan.index')
            ->with('success', 'Kunjungan baru berhasil ditambahkan.');
    }
}
