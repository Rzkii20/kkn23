<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePesanKontakRequest;
use App\Models\PesanKontak;
use Illuminate\Http\RedirectResponse;

class KontakController extends Controller
{
    /**
     * Handle the contact form submission.
     */
    public function store(StorePesanKontakRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        PesanKontak::create([
            'nama'   => $validated['nama'],
            'email'  => $validated['email'],
            'subjek' => $validated['subjek'],
            'pesan'  => $validated['pesan'],
        ]);

        return redirect()->route('kontak')
            ->with('success', 'Terima kasih! Pesan Anda telah berhasil terkirim. Kami akan segera menghubungi Anda.');
    }
}
