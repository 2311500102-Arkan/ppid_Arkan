<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('status')) {
            $query->where('is_read', $request->input('status') === 'read');
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->latest('created_at')->paginate(15)->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified contact message and mark as read.
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Pesan masuk berhasil dihapus.');
    }
}
