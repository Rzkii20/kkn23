<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGaleriRequest;
use App\Models\Galeri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function index(): View
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create(): View
    {
        return view('admin.galeri.create');
    }

    public function store(StoreGaleriRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $filePath = null;
        if ($validated['tipe'] === 'foto') {
            $filePath = $request->file('file_foto')->store('galeri', 'public');
        } else {
            // Convert youtube link to embed format if needed, or just save the URL
            $filePath = $request->input('file_video');
        }

        Galeri::create([
            'judul' => $validated['judul'],
            'tipe' => $validated['tipe'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Media berhasil ditambahkan ke Galeri!');
    }

    public function edit(Galeri $galeri): View
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(StoreGaleriRequest $request, Galeri $galeri): RedirectResponse
    {
        $validated = $request->validated();

        $filePath = $galeri->file_path;
        
        // If type changed from video to foto or vice versa
        if ($validated['tipe'] !== $galeri->tipe) {
            if ($galeri->tipe === 'foto') {
                Storage::disk('public')->delete($galeri->file_path);
            }
            if ($validated['tipe'] === 'foto') {
                $filePath = $request->file('file_foto')->store('galeri', 'public');
            } else {
                $filePath = $request->input('file_video');
            }
        } else {
            // Type is same
            if ($validated['tipe'] === 'foto') {
                if ($request->hasFile('file_foto')) {
                    Storage::disk('public')->delete($filePath);
                    $filePath = $request->file('file_foto')->store('galeri', 'public');
                }
            } else {
                $filePath = $request->input('file_video');
            }
        }

        $galeri->update([
            'judul' => $validated['judul'],
            'tipe' => $validated['tipe'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri): RedirectResponse
    {
        if ($galeri->tipe === 'foto' && $galeri->file_path) {
            Storage::disk('public')->delete($galeri->file_path);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Item Galeri berhasil dihapus!');
    }
}
