<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PesanController extends Controller
{
    public function index(): View
    {
        $pesans = PesanKontak::latest()->paginate(15);
        return view('admin.pesan.index', compact('pesans'));
    }

    public function show(PesanKontak $pesan): View
    {
        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy(PesanKontak $pesan): RedirectResponse
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
