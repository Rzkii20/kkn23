<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DokumenController extends Controller
{
    public function index(): View
    {
        $dokumens = Dokumen::latest()->get();
        return view('admin.dokumen.index', compact('dokumens'));
    }

    public function create(): View
    {
        $kategoris = $this->getKategoris();
        return view('admin.dokumen.create', compact('kategoris'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'deskripsi'    => 'nullable|string|max:500',
            'tahun'        => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'file_dokumen' => 'required|file|mimes:pdf|max:10240',
        ], [
            'file_dokumen.mimes' => 'File harus berformat PDF agar dapat dibaca secara aman di web tanpa bisa diunduh.',
        ]);

        $filePath = $request->file('file_dokumen')->store('dokumen', 'public');

        Dokumen::create([
            'judul'        => $validated['judul'],
            'kategori'     => $validated['kategori'],
            'deskripsi'    => $validated['deskripsi'] ?? null,
            'tahun'        => $validated['tahun'],
            'file_dokumen' => $filePath,
        ]);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil ditambahkan!');
    }

    public function edit(Dokumen $dokumen): View
    {
        $kategoris = $this->getKategoris();
        return view('admin.dokumen.edit', compact('dokumen', 'kategoris'));
    }

    public function update(Request $request, Dokumen $dokumen): RedirectResponse
    {
        $validated = $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string|max:100',
            'deskripsi'    => 'nullable|string|max:500',
            'tahun'        => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'file_dokumen' => 'nullable|file|mimes:pdf|max:10240',
        ], [
            'file_dokumen.mimes' => 'File harus berformat PDF agar dapat dibaca secara aman di web tanpa bisa diunduh.',
        ]);

        $filePath = $dokumen->file_dokumen;
        if ($request->hasFile('file_dokumen')) {
            if ($filePath) Storage::disk('public')->delete($filePath);
            $filePath = $request->file('file_dokumen')->store('dokumen', 'public');
        }

        $dokumen->update([
            'judul'        => $validated['judul'],
            'kategori'     => $validated['kategori'],
            'deskripsi'    => $validated['deskripsi'] ?? null,
            'tahun'        => $validated['tahun'],
            'file_dokumen' => $filePath,
        ]);

        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy(Dokumen $dokumen): RedirectResponse
    {
        if ($dokumen->file_dokumen) {
            Storage::disk('public')->delete($dokumen->file_dokumen);
        }
        $dokumen->delete();
        return redirect()->route('admin.dokumen.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    private function getKategoris(): array
    {
        return [
            'Peraturan Desa',
            'APBDes',
            'Laporan',
            'Surat Keputusan',
            'Profil Desa',
            'Rencana Pembangunan',
            'Lainnya',
        ];
    }
}
