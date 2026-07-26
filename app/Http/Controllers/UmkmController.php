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

        // Generate QR Code URL dynamically using qrserver API pointing to this page's route
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=" . urlencode(route('umkm.show', $umkm->slug));

        return view('pages.umkm.show', compact('umkm', 'produks', 'qrCodeUrl'));
    }
}
