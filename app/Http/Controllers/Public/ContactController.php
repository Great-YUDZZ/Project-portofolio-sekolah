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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:35'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        ContactMessage::create($validated);

        return redirect()
            ->route('contact.index')
            ->with('toast_success', 'Pesan Anda berhasil dikirim ke bagian Humas SMK Negeri 1 Denpasar.');
    }
}
