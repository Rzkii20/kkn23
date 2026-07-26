<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\View\View;

class WisataController extends Controller
{
    public function index(): View
    {
        $wisatas = Wisata::latest()->paginate(9);
        return view('pages.wisata.index', compact('wisatas'));
    }

    public function show(string $slug): View
    {
        $wisata = Wisata::where('slug', $slug)->firstOrFail();
        $related = Wisata::where('id', '!=', $wisata->id)->inRandomOrder()->take(3)->get();
        return view('pages.wisata.show', compact('wisata', 'related'));
    }
}
