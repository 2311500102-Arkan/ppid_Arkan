<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Objection;
use Illuminate\Http\Request;

class ObjectionController extends Controller
{
    /**
     * Display a listing of objections.
     */
    public function index(Request $request)
    {
        $query = Objection::with('informationRequest');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('objection_number', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('reason', 'like', "%{$search}%");
            });
        }

        $objections = $query->latest('created_at')->paginate(15)->withQueryString();

        $statuses = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'rejected' => 'Ditolak',
        ];

        return view('admin.objections.index', compact('objections', 'statuses'));
    }

    /**
     * Display the specified objection details.
     */
    public function show($id)
    {
        $objection = Objection::with('informationRequest')->findOrFail($id);

        $statuses = [
            'pending' => 'Menunggu',
            'processing' => 'Diproses',
            'completed' => 'Selesai',
            'rejected' => 'Ditolak',
        ];

        return view('admin.objections.show', compact('objection', 'statuses'));
    }

    /**
     * Update the status and official response of the objection.
     */
    public function updateStatus(Request $request, $id)
    {
        $objection = Objection::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
            'response' => 'nullable|string',
        ]);

        $objection->update([
            'status' => $validated['status'],
            'response' => $validated['response'] ?? $objection->response,
        ]);

        return redirect()->back()->with('success', 'Status pengajuan keberatan berhasil diperbarui.');
    }

    /**
     * Remove the specified objection from storage.
     */
    public function destroy($id)
    {
        $objection = Objection::findOrFail($id);
        $objection->delete();

        return redirect()->route('admin.objections.index')->with('success', 'Pengajuan keberatan berhasil dihapus.');
    }
}
