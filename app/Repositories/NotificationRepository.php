<?php

namespace App\Repositories;

use App\Http\Resources\V1\NotificationCollection;
use App\Http\Resources\V1\NotificationResource;
use App\Models\Notification;
use App\Traits\FunctionGeneralTrait;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\FunctionGeneralTraitS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationRepository
{
    use FunctionGeneralTrait;

    public function getAll()
    {
        $notifications = Notification::query()->with(['sender', 'receptor'])->get();
        return $notifications;
    }

    public function getByAuthenticated(Request $request)
    {
        $notifications = Notification::query()->with(['sender', 'receptor'])->where(['receptor_id' => $request->user_id, 'trash' => 0])->get();
        return $notifications;
    }

    public function markAsRead($request, $id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification->receptor_id == $request->user_id){
            $notification->update(['read' => 1]);
            $notification->save();
        }

        return $notification;
    }

    public function trash($request, $id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification->receptor_id == $request->user_id){
            $notification->update(['trash' => 1]);
            $notification->save();
        }

        return $notification;
    }
}
