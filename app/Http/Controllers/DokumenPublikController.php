<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DokumenController extends Controller
{
    public function index(Request $request): View
    {
        $query = Dokumen::latest();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $dokumens  = $query->get();
        $kategoris = Dokumen::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');
        $tahuns    = Dokumen::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun');

        return view('pages.dokumen', compact('dokumens', 'kategoris', 'tahuns'));
    }
}
