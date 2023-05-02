<?php

namespace App\Actions\Notifications;

use App\Http\Resources\MobileAppNotificationResourceCollection;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
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

    public function jsonResponse(Collection $notifications): JsonResponse
    {
        return response()->json([
            'notifications' => new MobileAppNotificationResourceCollection($notifications)
        ]);
    }
}
