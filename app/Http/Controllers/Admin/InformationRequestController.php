<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformationRequest;
use Illuminate\Http\Request;

class InformationRequestController extends Controller
{
    /**
     * Display a listing of information requests.
     */
    public function index(Request $request)
    {
        $query = InformationRequest::withCount('objections');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('request_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('information_requested', 'like', "%{$search}%");
            });
        }

        $requests = $query->latest('created_at')->paginate(15)->withQueryString();

        $statuses = [
            'pending'    => 'Menunggu',
            'processing' => 'Diproses',
            'completed'  => 'Selesai',
            'rejected'   => 'Ditolak',
        ];

        $counts = [
            'pending'    => InformationRequest::where('status', 'pending')->count(),
            'processing' => InformationRequest::where('status', 'processing')->count(),
            'completed'  => InformationRequest::where('status', 'completed')->count(),
            'rejected'   => InformationRequest::where('status', 'rejected')->count(),
        ];

        return view('admin.information-requests.index', compact('requests', 'statuses', 'counts'));
    }

    /**
     * Display the specified information request with its objections.
     */
    public function show($id)
    {
        $informationRequest = InformationRequest::with('objections')->findOrFail($id);

        $statuses = [
            'pending'    => 'Menunggu',
            'processing' => 'Diproses',
            'completed'  => 'Selesai',
            'rejected'   => 'Ditolak',
        ];

        return view('admin.information-requests.show', compact('informationRequest', 'statuses'));
    }

    /**
     * Update the status and official response of the information request.
     */
    public function updateStatus(Request $request, $id)
    {
        $infoRequest = InformationRequest::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
            'response' => 'nullable|string',
        ]);

        $data = [
            'status' => $validated['status'],
            'response' => $validated['response'] ?? $infoRequest->response,
        ];

        if ($validated['status'] === 'completed' || ($request->filled('response') && !$infoRequest->responded_at)) {
            $data['responded_at'] = now();
        }

        $infoRequest->update($data);

        return redirect()->back()->with('success', 'Status permohonan informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified information request from storage.
     */
    public function destroy($id)
    {
        $infoRequest = InformationRequest::findOrFail($id);
        $infoRequest->delete();

        return redirect()->route('admin.information-requests.index')->with('success', 'Permohonan informasi berhasil dihapus.');
    }
}
