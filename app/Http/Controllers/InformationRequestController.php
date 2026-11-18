<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformationRequestController extends Controller
{
    /**
     * Show the form for creating a new information request.
     */
    public function create(): View
    {
        return view('information-request.create');
    }

    /**
     * Store a newly created information request in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|min:16|max:20',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'occupation' => 'nullable|string|max:255',
            'information_requested' => 'required|string',
            'purpose' => 'nullable|string',
            'how_to_get' => 'required|in:online,email,fax,pos',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.min' => 'NIK minimal berjumlah 16 digit.',
            'address.required' => 'Alamat lengkap wajib diisi.',
            'information_requested.required' => 'Rincian informasi yang diminta wajib diisi.',
            'how_to_get.required' => 'Cara memperoleh informasi wajib dipilih.',
            'how_to_get.in' => 'Pilihan cara memperoleh informasi tidak valid.',
        ]);

        $requestNumber = 'REQ-' . date('Ymd') . '-' . str_pad(InformationRequest::count() + 1, 4, '0', STR_PAD_LEFT);

        $validated['request_number'] = $requestNumber;
        $validated['status'] = 'pending';

        InformationRequest::create($validated);

        return redirect()->back()
            ->with('success', 'Permohonan informasi berhasil dikirim dengan nomor pendaftaran: ' . $requestNumber)
            ->with('request_number', $requestNumber);
    }

    /**
     * Check the status of an information request by its request number.
     */
    public function status(Request $request): View
    {
        $requestNumber = $request->input('request_number');
        $informationRequest = null;
        $searched = false;

        if ($requestNumber !== null && trim($requestNumber) !== '') {
            $searched = true;
            $informationRequest = InformationRequest::where('request_number', trim($requestNumber))->first();
        }

        return view('information-request.status', compact('informationRequest', 'requestNumber', 'searched'));
    }
}
