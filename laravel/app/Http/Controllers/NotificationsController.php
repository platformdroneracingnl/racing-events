<?php

namespace App\Http\Controllers;

use Auth;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show all notification for user
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(20);

        return view('backend.notifications.index', compact('notifications'));
    }

    // Mark single notification as read
    public function read($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();

            return redirect()->back();
        }
    }

    // Mark all unread notification as read
    public function readAll()
    {
        $notifications = Auth::user()->unreadNotifications;
        if ($notifications) {
            $notifications->markAsRead();

            return redirect()->back();
        }
    }

    // Remove single notification from database
    public function remove($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->delete();

            return redirect()->back();
        }
    }

    // Remove all notifications
    public function removeAll()
    {
        $notifications = Auth::user()->notifications();
        if ($notifications) {
            $notifications->delete();

            return redirect()->back();
        }
    }

    // Go to link from notification
    public function show($id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        // If notification can be found, mark as read and go to link
        if ($notification) {
            $notification->markAsRead();

            return redirect($notification->data['url']);
        }
    }
}
