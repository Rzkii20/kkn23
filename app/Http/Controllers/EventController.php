<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        // Upcoming and ongoing events
        $events = Event::where('tanggal_selesai', '>=', now()->toDateString())
            ->orderBy('tanggal_mulai', 'asc')
            ->paginate(6);
            
        // Past events
        $pastEvents = Event::where('tanggal_selesai', '<', now()->toDateString())
            ->orderBy('tanggal_mulai', 'desc')
            ->take(3)
            ->get();
            
        return view('pages.event.index', compact('events', 'pastEvents'));
    }

    public function show(string $slug): View
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        
        $otherEvents = Event::where('id', '!=', $event->id)
            ->where('tanggal_selesai', '>=', now()->toDateString())
            ->orderBy('tanggal_mulai', 'asc')
            ->take(4)
            ->get();
            
        return view('pages.event.show', compact('event', 'otherEvents'));
    }
}
