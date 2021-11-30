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

    public function is_seen(Request $request)
    {
        $notification = Notification::where('id', $request->get('id'))->update([
            'is_seen' => true
        ]);
        return $this->successResponse();
    }
}
