<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10); // جلب 10 إشعارات لكل صفحة
        return view('cpanel.notifications.index', compact('notifications'));
    }
    public function markAsRead(Request $request)
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back()->with('success', 'Notifications marked as read.');
    }
}
