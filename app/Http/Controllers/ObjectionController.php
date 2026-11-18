<?php

namespace App\Http\Controllers;

use App\Models\Objection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ObjectionController extends Controller
{
    /**
     * Show the form for creating a new objection.
     */
    public function create(): View
    {
        return view('objection.create');
    }

    /**
     * Store a newly created objection in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'information_request_id' => 'nullable|integer',
            'reason' => 'required|string',
        ], [
            'name.required' => 'Nama lengkap pemohon wajib diisi.',
            'address.required' => 'Alamat lengkap wajib diisi.',
            'reason.required' => 'Alasan pengajuan keberatan wajib diisi.',
        ]);

        $objectionNumber = 'OBJ-' . date('Ymd') . '-' . str_pad(Objection::count() + 1, 4, '0', STR_PAD_LEFT);

        $validated['objection_number'] = $objectionNumber;
        $validated['status'] = 'pending';

        Objection::create($validated);

        return redirect()->back()
            ->with('success', 'Pengajuan keberatan berhasil dikirim dengan nomor: ' . $objectionNumber)
            ->with('objection_number', $objectionNumber);
    }
}
