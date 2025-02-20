<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Notifications\NewMessageNotification;
use App\Traits\ApiResponseTrait;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Notifications\Events\NotificationSent;

class NotificationController extends Controller
{
    use ApiResponseTrait;
    public function sendNotification(NotificationRequest $request)
    {
        $user = Auth::user();

        if(!$user){
           return $this->errorResponse('user not found ' , 404);
        }
        auth()->user()->notify(new NewMessageNotification($request->title, $request->body));

        return $this->successResponse(null, 'Notification sent successfully');
    }

    public function getNotifications()
{
    $notifications = auth()->user()->notifications; 

    return $this->successResponse($notifications, 'Notifications retrieved successfully');
}

}
