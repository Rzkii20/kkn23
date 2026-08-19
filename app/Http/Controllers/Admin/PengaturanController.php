<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class PengaturanController extends Controller
{
    /**
     * Tampilkan halaman pengaturan akun admin.
     */
    public function edit(): View
    {
        return view('admin.pengaturan.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update profil (nama, email, foto).
     */
    public function updateProfil(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', 'unique:users,email,' . $user->id],
            'foto'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan akun lain.',
            'foto.image'     => 'File harus berupa gambar.',
            'foto.max'       => 'Ukuran foto maksimal 2 MB.',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika bukan default
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto')->store('profil-admin', 'public');
            $user->foto_profil = $path;
        }

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.pengaturan.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Update password admin.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'password_lama'     => ['required', 'string'],
            'password_baru'     => ['required', 'confirmed', Password::min(8)],
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.confirmed'=> 'Konfirmasi password tidak cocok.',
            'password_baru.min'      => 'Password minimal 8 karakter.',
        ]);

        // Verifikasi password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.'])->withInput();
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->route('admin.pengaturan.edit')
            ->with('success', 'Password berhasil diubah. Silakan login kembali jika diperlukan.');
    }

    /**
     * Hapus foto profil admin.
     */
    public function hapusFoto(): RedirectResponse
    {
        $user = Auth::user();

        if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
            Storage::disk('public')->delete($user->foto_profil);
        }

        $user->foto_profil = null;
        $user->save();

        return redirect()->route('admin.pengaturan.edit')
            ->with('success', 'Foto profil berhasil dihapus.');
    }
}
