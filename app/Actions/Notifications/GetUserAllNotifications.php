<?php

namespace App\Actions\Notifications;

use App\Http\Resources\MobileAppNotificationResourceCollection;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserAllNotifications
{
    use AsAction;

    public function asController(): Collection
    {
        return $this->handle(auth("sanctum")->id());
    }

    public function handle(int $userId): Collection
    {
        $user = User::findOrFail($userId);
        return $user->notifications;
    }

    public function jsonResponse(Collection $notifications): MobileAppNotificationResourceCollection
    {
        return new MobileAppNotificationResourceCollection($notifications);
    }
}
