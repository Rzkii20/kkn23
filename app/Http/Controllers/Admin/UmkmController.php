<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUmkmRequest;
use App\Http\Requests\Admin\UpdateUmkmRequest;
use App\Models\Umkm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $umkms = Umkm::latest()->get();
        return view('admin.umkm.index', compact('umkms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.umkm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUmkmRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Handle File Upload
        $fotoPath = null;
        if ($request->hasFile('foto_toko')) {
            $fotoPath = $request->file('foto_toko')->store('umkm', 'public');
        }

        // Clean WhatsApp number
        $whatsapp = $validated['no_whatsapp'];
        if (str_starts_with($whatsapp, '0')) {
            $whatsapp = '62' . substr($whatsapp, 1);
        } elseif (str_starts_with($whatsapp, '+')) {
            $whatsapp = substr($whatsapp, 1);
        }

        // Create UMKM
        Umkm::create([
            'nama_usaha'  => $validated['nama_usaha'],
            'slug'        => Str::slug($validated['nama_usaha']) . '-' . rand(1000, 9999),
            'deskripsi'   => $validated['deskripsi'],
            'alamat'      => $validated['alamat'],
            'no_whatsapp' => $whatsapp,
            'latitude'    => $validated['latitude'] ?? null,
            'longitude'   => $validated['longitude'] ?? null,
            'foto_toko'   => $fotoPath,
            'status_aktif' => true,
        ]);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Profil UMKM berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm): View
    {
        return view('admin.umkm.edit', compact('umkm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUmkmRequest $request, Umkm $umkm): RedirectResponse
    {
        $validated = $request->validated();

        // Handle File Upload
        $fotoPath = $umkm->foto_toko;
        if ($request->hasFile('foto_toko')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto_toko')->store('umkm', 'public');
        }

        // Clean WhatsApp number
        $whatsapp = $validated['no_whatsapp'];
        if (str_starts_with($whatsapp, '0')) {
            $whatsapp = '62' . substr($whatsapp, 1);
        } elseif (str_starts_with($whatsapp, '+')) {
            $whatsapp = substr($whatsapp, 1);
        }

        // Update UMKM
        $umkm->update([
            'nama_usaha'   => $validated['nama_usaha'],
            'deskripsi'    => $validated['deskripsi'],
            'alamat'       => $validated['alamat'],
            'no_whatsapp'  => $whatsapp,
            'latitude'     => $validated['latitude'] ?? null,
            'longitude'    => $validated['longitude'] ?? null,
            'foto_toko'    => $fotoPath,
            'status_aktif' => $validated['status_aktif'],
        ]);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Profil UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umkm $umkm): RedirectResponse
    {
        // Delete photo if exists
        if ($umkm->foto_toko) {
            Storage::disk('public')->delete($umkm->foto_toko);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')
            ->with('success', 'Data UMKM berhasil dihapus!');
    }
}
