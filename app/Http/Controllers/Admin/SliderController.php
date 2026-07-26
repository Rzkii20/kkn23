<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSliderRequest;
use App\Models\BannerSlider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    public function index(): View
    {
        $sliders = BannerSlider::orderBy('urutan')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create(): View
    {
        return view('admin.slider.create');
    }

    public function store(StoreSliderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = $request->file('foto_banner')->store('slider', 'public');

        BannerSlider::create([
            'judul'       => $validated['judul'],
            'subjudul'    => $validated['subjudul'],
            'foto_banner' => $fotoPath,
            'urutan'      => $validated['urutan'] ?? 0,
        ]);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Banner slider berhasil ditambahkan!');
    }

    public function edit(BannerSlider $slider): View
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(StoreSliderRequest $request, BannerSlider $slider): RedirectResponse
    {
        $validated = $request->validated();

        $fotoPath = $slider->foto_banner;
        if ($request->hasFile('foto_banner')) {
            if ($fotoPath) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto_banner')->store('slider', 'public');
        }

        $slider->update([
            'judul'       => $validated['judul'],
            'subjudul'    => $validated['subjudul'],
            'foto_banner' => $fotoPath,
            'urutan'      => $validated['urutan'] ?? $slider->urutan,
        ]);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Banner slider berhasil diperbarui!');
    }

    public function destroy(BannerSlider $slider): RedirectResponse
    {
        if ($slider->foto_banner) {
            Storage::disk('public')->delete($slider->foto_banner);
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Banner slider berhasil dihapus!');
    }
}
