<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Show the contact settings form
     */
    public function contact()
    {
        $settings = Setting::getWhatsAppSettings();

        return view('admin.settings.contact', [
            'whatsapp_number' => $settings['whatsapp_number'],
            'whatsapp_message' => $settings['whatsapp_message'],
            'is_whatsapp_enabled' => $settings['is_whatsapp_enabled'],
        ]);
    }

    /**
     * Update the contact settings
     */
    public function updateContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'whatsapp_number' => 'required|numeric',
            'whatsapp_message' => 'required|string|max:1000',
            'is_whatsapp_enabled' => 'boolean',
        ], [
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_number.numeric' => 'Nomor WhatsApp harus berupa angka (tanpa + atau simbol lain).',
            'whatsapp_message.required' => 'Pesan default wajib diisi.',
            'whatsapp_message.max' => 'Pesan maksimal 1000 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.settings.contact')
                ->withErrors($validator)
                ->withInput();
        }

        // Save settings
        Setting::set('whatsapp_number', $request->whatsapp_number);
        Setting::set('whatsapp_message', $request->whatsapp_message);
        Setting::set('is_whatsapp_enabled', $request->has('is_whatsapp_enabled') ? 'true' : 'false');

        // Clear cache
        Setting::clearWhatsAppCache();

        return redirect()
            ->route('admin.settings.contact')
            ->with('success', 'Pengaturan kontak WhatsApp berhasil disimpan.');
    }

    /**
     * Show the password settings form
     */
    public function password()
    {
        return view('admin.settings.password');
    }

    /**
     * Update the password
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.settings.password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = auth()->user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()
                ->route('admin.settings.password')
                ->withErrors(['current_password' => 'Password saat ini tidak benar.'])
                ->withInput();
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.settings.password')
            ->with('success', 'Password berhasil diubah.');
    }
}

