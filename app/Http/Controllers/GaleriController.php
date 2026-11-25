<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function index(Request $request): View
    {
        $sort = $request->query('sort') === 'terlama' ? 'terlama' : 'terbaru';

        $query = Galeri::query();
        if ($sort === 'terlama') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $galeris = $query->paginate(24)->withQueryString();

        return view('pages.galeri.index', compact('galeris', 'sort'));
    }
}
