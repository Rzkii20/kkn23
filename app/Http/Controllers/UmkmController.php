<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UmkmController extends Controller
{
    /**
     * Display a listing of active UMKM.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search');

        $umkms = Umkm::where('status_aktif', true)
            ->when($search, function ($query, $search) {
                return $query->where('nama_usaha', 'like', '%' . $search . '%')
                             ->orWhere('deskripsi', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(8);

        return view('pages.umkm.index', compact('umkms', 'search'));
    }

    /**
     * Display the specified UMKM details.
     */
    public function show(string $slug): View
    {
        $umkm = Umkm::where('slug', $slug)
            ->where('status_aktif', true)
            ->firstOrFail();

        // Fetch products associated with this UMKM
        $produks = $umkm->produk()->with('kategori')->latest()->get();

        return view('pages.umkm.show', compact('umkm', 'produks'));
    }
}
