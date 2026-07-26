<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWisataRequest;
use App\Models\Wisata;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WisataController extends Controller
{
    public function index(): View
    {
        $wisatas = Wisata::latest()->get();
        return view('admin.wisata.index', compact('wisatas'));
    }

    public function create(): View
    {
        return view('admin.wisata.create');
    }

    public function store(StoreWisataRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = null;
        if ($request->hasFile('foto_wisata')) {
            $fotoPath = $request->file('foto_wisata')->store('wisata', 'public');
        }

        Wisata::create([
            'nama_wisata' => $validated['nama_wisata'],
            'slug' => Str::slug($validated['nama_wisata']) . '-' . rand(100, 999),
            'deskripsi' => $validated['deskripsi'],
            'alamat' => $validated['alamat'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'foto_wisata' => $fotoPath,
        ]);

        return redirect()->route('admin.wisata.index')->with('success', 'Objek Wisata berhasil ditambahkan!');
    }

    public function edit(Wisata $wisatum): View
    {
        $wisata = $wisatum; // the model binding parameter might be named $wisatum due to Laravel's pluralization
        return view('admin.wisata.edit', compact('wisata'));
    }

    public function update(StoreWisataRequest $request, Wisata $wisatum): RedirectResponse
    {
        $wisata = $wisatum;
        $validated = $request->validated();

        $fotoPath = $wisata->foto_wisata;
        if ($request->hasFile('foto_wisata')) {
            if ($fotoPath) Storage::disk('public')->delete($fotoPath);
            $fotoPath = $request->file('foto_wisata')->store('wisata', 'public');
        }

        $wisata->update([
            'nama_wisata' => $validated['nama_wisata'],
            'deskripsi' => $validated['deskripsi'],
            'alamat' => $validated['alamat'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'foto_wisata' => $fotoPath,
        ]);

        return redirect()->route('admin.wisata.index')->with('success', 'Objek Wisata berhasil diperbarui!');
    }

    public function destroy(Wisata $wisatum): RedirectResponse
    {
        $wisata = $wisatum;
        if ($wisata->foto_wisata) {
            Storage::disk('public')->delete($wisata->foto_wisata);
        }

        $wisata->delete();

        return redirect()->route('admin.wisata.index')->with('success', 'Objek Wisata berhasil dihapus!');
    }
}
