<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StrukturDesaController extends Controller
{
    public function index(): View
    {
        $strukturs = StrukturDesa::orderBy('urutan')->get();
        return view('admin.struktur.index', compact('strukturs'));
    }

    public function create(): View
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'required|string|max:255',
            'periode'  => 'nullable|string|max:100',
            'nomor_hp' => 'nullable|string|max:20',
            'urutan'   => 'required|integer|min:0',
            'is_active'=> 'sometimes|boolean',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('struktur', 'public');
        }

        StrukturDesa::create([
            'nama'      => $validated['nama'],
            'jabatan'   => $validated['jabatan'],
            'periode'   => $validated['periode'] ?? null,
            'nomor_hp'  => $validated['nomor_hp'] ?? null,
            'urutan'    => $validated['urutan'],
            'is_active' => $request->has('is_active') ? (bool) $request->input('is_active') : true,
            'foto'      => $fotoPath,
        ]);

        return redirect()->route('admin.struktur-desa.index')
            ->with('success', 'Anggota struktur desa berhasil ditambahkan!');
    }

    public function edit(StrukturDesa $strukturDesa): View
    {
        return view('admin.struktur.edit', compact('strukturDesa'));
    }

    public function update(Request $request, StrukturDesa $strukturDesa): RedirectResponse
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'jabatan'  => 'required|string|max:255',
            'periode'  => 'nullable|string|max:100',
            'nomor_hp' => 'nullable|string|max:20',
            'urutan'   => 'required|integer|min:0',
            'is_active'=> 'sometimes|boolean',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoPath = $strukturDesa->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('struktur', 'public');
        }

        $strukturDesa->update([
            'nama'      => $validated['nama'],
            'jabatan'   => $validated['jabatan'],
            'periode'   => $validated['periode'] ?? null,
            'nomor_hp'  => $validated['nomor_hp'] ?? null,
            'urutan'    => $validated['urutan'],
            'is_active' => $request->has('is_active') ? (bool) $request->input('is_active') : false,
            'foto'      => $fotoPath,
        ]);

        return redirect()->route('admin.struktur-desa.index')
            ->with('success', 'Data anggota struktur desa berhasil diperbarui!');
    }

    public function destroy(StrukturDesa $strukturDesa): RedirectResponse
    {
        if ($strukturDesa->foto) {
            Storage::disk('public')->delete($strukturDesa->foto);
        }

        $strukturDesa->delete();

        return redirect()->route('admin.struktur-desa.index')
            ->with('success', 'Anggota struktur desa berhasil dihapus!');
    }
}
