<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class DokumenPublikController extends Controller
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

    /**
     * Tampilkan file dokumen secara inline di browser (bisa dilihat, tidak ada prompt download).
     */
    public function lihat(Dokumen $dokumen): Response
    {
        $filePath = storage_path('app/public/' . $dokumen->file_dokumen);

        abort_unless(file_exists($filePath), 404, 'File tidak ditemukan.');

        $ext     = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mimeMap = [
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls'  => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];
        $mimeType = $mimeMap[$ext] ?? 'application/octet-stream';

        return response(file_get_contents($filePath), 200, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline; filename="dokumen.' . $ext . '"',
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control'       => 'no-store, no-cache',
        ]);
    }
}
