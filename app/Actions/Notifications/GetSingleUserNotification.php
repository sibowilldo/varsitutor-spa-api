<?php

namespace App\Actions\Notifications;

use App\Http\Resources\MobileAppNotificationResource;
use Illuminate\Auth\Access\Response;
use Illuminate\Notifications\DatabaseNotification;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSingleUserNotification
{
    use AsAction;

    public function asController(string $id): DatabaseNotification
    {
        return $this->handle($id);
    }

    public function handle(string $id): DatabaseNotification
    {
        $notification = auth("sanctum")->user()->notifications()->where('id', $id)->first();
            $notification?->read_at ?? $notification->markAsRead();
        return $notification;
    }

    public function jsonResponse(DatabaseNotification $notification): MobileAppNotificationResource
    {
        return new MobileAppNotificationResource($notification);
    }
}
