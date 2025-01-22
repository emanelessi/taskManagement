<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications;
        \Log::info($notifications);
        return view('notifications.index', compact('notifications'));
    }

    // تعليم الإشعارات كمقروءة
    public function markAsRead(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Notifications marked as read.');
    }
}
