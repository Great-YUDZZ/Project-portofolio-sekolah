<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MessageController extends Controller
{
    protected function authorizeAdmin(): void
    {
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Hanya Administrator yang memiliki akses ke pesan masuk Humas.');
        }
    }

    public function index(Request $request): View
    {
        $this->authorizeAdmin();

        $query = ContactMessage::query();

        // Filter status baca
        $status = $request->query('status', 'all');
        if ($status === 'unread') {
            $query->where('is_read', false);
        } elseif ($status === 'read') {
            $query->where('is_read', true);
        }

        // Pencarian teks
        if ($request->filled('q')) {
            $search = '%' . trim($request->query('q')) . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                  ->orWhere('email', 'like', $search)
                  ->orWhere('phone', 'like', $search)
                  ->orWhere('subject', 'like', $search)
                  ->orWhere('message', 'like', $search);
            });
        }

        $messages = $query->latest()->paginate(15)->withQueryString();
        $unreadCount = ContactMessage::where('is_read', false)->count();
        $totalCount = ContactMessage::count();

        return view('panel.messages.index', compact('messages', 'unreadCount', 'totalCount', 'status'));
    }

    public function show(ContactMessage $message): View
    {
        $this->authorizeAdmin();

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('panel.messages.show', compact('message'));
    }

    public function markRead(ContactMessage $message): RedirectResponse
    {
        $this->authorizeAdmin();

        $message->update(['is_read' => true]);

        return back()->with('toast_success', 'Pesan telah ditandai sebagai sudah dibaca.');
    }

    public function markUnread(ContactMessage $message): RedirectResponse
    {
        $this->authorizeAdmin();

        $message->update(['is_read' => false]);

        return back()->with('toast_success', 'Pesan dikembalikan ke status belum dibaca.');
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $this->authorizeAdmin();

        $message->delete();

        return redirect()->route('panel.messages.index')
            ->with('toast_success', 'Pesan kontak berhasil dihapus dari sistem.');
    }
}
