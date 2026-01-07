<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth::user()->notifications;

        return view('pages.notifications.index', compact('notifications'));
    }
}
