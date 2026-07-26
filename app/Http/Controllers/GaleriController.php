<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function index(): View
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('pages.galeri.index', compact('galeris'));
    }
}
