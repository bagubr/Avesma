<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notification = Notification::whereUserId($request->user()->id)->orderBy('id', 'desc')->get();

        return $this->sendSuccessResponse([
            'notification' => $notification
        ]);
    }
}
