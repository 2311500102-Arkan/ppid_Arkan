<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show the contact page.
     */
    public function index(): View
    {
        return view('contact');
    }

    /**
     * Store a newly created contact message in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        $validated['is_read'] = false;

        Contact::create($validated);

        return redirect()->back()
            ->with('success', 'Pesan Anda telah berhasil dikirim. Terima kasih telah menghubungi kami.');
    }
}
