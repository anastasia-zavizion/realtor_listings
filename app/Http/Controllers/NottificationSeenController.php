<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NottificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        $this->authorize('update',$notification);
        $notification->markAsRead();
        return redirect()->back()->with('success', "Notification mark as read");
    }
}
