<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->get();
        return view('admin.event.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.event.create');
    }

    public function store(StoreEventRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = null;
        if ($request->hasFile('foto_event')) {
            $fotoPath = $request->file('foto_event')->store('event', 'public');
        }

        Event::create([
            'nama_event' => $validated['nama_event'],
            'slug' => Str::slug($validated['nama_event']) . '-' . rand(100, 999),
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'lokasi' => $validated['lokasi'],
            'foto_event' => $fotoPath,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Agenda Event berhasil ditambahkan!');
    }

    public function edit(Event $event): View
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(StoreEventRequest $request, Event $event): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = $event->foto_event;
        if ($request->hasFile('foto_event')) {
            if ($fotoPath) Storage::disk('public')->delete($fotoPath);
            $fotoPath = $request->file('foto_event')->store('event', 'public');
        }

        $event->update([
            'nama_event' => $validated['nama_event'],
            'deskripsi' => $validated['deskripsi'],
            'tanggal_mulai' => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'lokasi' => $validated['lokasi'],
            'foto_event' => $fotoPath,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Agenda Event berhasil diperbarui!');
    }

    public function destroy(Event $event): RedirectResponse
    {
        if ($event->foto_event) {
            Storage::disk('public')->delete($event->foto_event);
        }

        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Agenda Event berhasil dihapus!');
    }
}
