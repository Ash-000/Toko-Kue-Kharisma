<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserNotification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Ambil notifikasi user yang login (untuk dropdown)
     * Otomatis menghapus notifikasi yang sudah lewat 1 hari
     */
    public function index()
    {
        // Auto-cleanup: hapus notifikasi yang sudah lebih dari 1 hari
        UserNotification::where('user_id', Auth::id())
            ->where('created_at', '<', Carbon::now()->subDay())
            ->delete();

        $notifications = UserNotification::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

        $unreadCount = UserNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json([
            'success'      => true,
            'notifications'=> $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca
     */
    public function markAllRead()
    {
        UserNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Tandai satu notifikasi sebagai sudah dibaca
     */
    public function markRead($id)
    {
        UserNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
