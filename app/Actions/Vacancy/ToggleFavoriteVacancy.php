<?php

namespace App\Actions\Vacancy;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Contracts\Auth\Authenticatable;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleFavoriteVacancy
{
    use AsAction;

    public function handle(int $authUserId, Vacancy $vacancy): bool|null
    {
        $favorite = Favorite::where(['user_id' => $authUserId, 'vacancy_id' => $vacancy->id])->first();
        if ($favorite != null) {
            $favorite->delete();

            return null;
        }
        Favorite::create(['user_id' => $authUserId, 'vacancy_id' => $vacancy->id]);

        return true;
    }

    public function asController(Vacancy $vacancy): bool|null
    {
        return $this->handle(auth('sanctum')->id(), $vacancy);
    }

    public function jsonResponse($response)
    {
        if ($response) {
            return response()->json(['message' => 'You Liked this Vacancy']);
        }

            return response()->json(['message' => 'You unliked this Vacancy']);

    }
}
