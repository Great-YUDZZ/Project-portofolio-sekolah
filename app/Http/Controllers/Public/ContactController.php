<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::pluck('value', 'key');

        return view('public.contact', compact('settings'));
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Honeypot check for automated spam bots
        if ($request->filled('website_hp')) {
            return redirect()
                ->route('contact.index')
                ->with('toast_success', 'Pesan Anda berhasil dikirim ke bagian Humas SMK Negeri 1 Denpasar.');
        }

        // 2. Application-level IP rate limit (5 messages per 10 minutes)
        $throttleKey = 'contact-ip|' . $request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);
            throw \Illuminate\Validation\ValidationException::withMessages([
                'message' => "Terlalu banyak pengiriman pesan dari jaringan Anda. Silakan tunggu sekitar {$minutes} menit lagi.",
            ]);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:35'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 600);

        ContactMessage::create([
            'name' => trim(strip_tags($validated['name'])),
            'email' => trim($validated['email']),
            'phone' => isset($validated['phone']) ? trim(strip_tags($validated['phone'])) : null,
            'subject' => trim(strip_tags($validated['subject'])),
            'message' => trim(strip_tags($validated['message'])),
        ]);

        return redirect()
            ->route('contact.index')
            ->with('toast_success', 'Pesan Anda berhasil dikirim ke bagian Humas SMK Negeri 1 Denpasar.');
    }
}
