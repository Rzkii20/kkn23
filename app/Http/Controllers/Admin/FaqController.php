<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::latest()->get();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faq.create');
    }

    public function store(StoreFaqRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Faq::create([
            'pertanyaan' => $validated['pertanyaan'],
            'jawaban'    => $validated['jawaban'],
        ]);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(StoreFaqRequest $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validated();

        $faq->update([
            'pertanyaan' => $validated['pertanyaan'],
            'jawaban'    => $validated['jawaban'],
        ]);

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return redirect()->route('admin.faq.index')
            ->with('success', 'FAQ berhasil dihapus!');
    }
}
