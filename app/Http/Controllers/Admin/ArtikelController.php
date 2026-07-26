<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArtikelRequest;
use App\Models\Artikel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ArtikelController extends Controller
{
    public function index(): View
    {
        $artikels = Artikel::latest()->get();
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create(): View
    {
        return view('admin.artikel.create');
    }

    public function store(StoreArtikelRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = null;
        if ($request->hasFile('foto_artikel')) {
            $fotoPath = $request->file('foto_artikel')->store('artikel', 'public');
        }

        Artikel::create([
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . rand(100, 999),
            'konten' => $validated['konten'],
            'foto_artikel' => $fotoPath,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit(Artikel $artikel): View
    {
        return view('admin.artikel.edit', compact('artikel'));
    }

    public function update(StoreArtikelRequest $request, Artikel $artikel): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = $artikel->foto_artikel;
        if ($request->hasFile('foto_artikel')) {
            if ($fotoPath) Storage::disk('public')->delete($fotoPath);
            $fotoPath = $request->file('foto_artikel')->store('artikel', 'public');
        }

        $artikel->update([
            'judul' => $validated['judul'],
            'konten' => $validated['konten'],
            'foto_artikel' => $fotoPath,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Artikel $artikel): RedirectResponse
    {
        if ($artikel->foto_artikel) {
            Storage::disk('public')->delete($artikel->foto_artikel);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
