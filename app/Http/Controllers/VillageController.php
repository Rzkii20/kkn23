<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class VillageController extends Controller
{
    /**
     * Display the 'About the Village' page (history, vision, mission).
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Display the 'Village Potential' page.
     */
    public function potential(): View
    {
        return view('pages.potential');
    }
}
