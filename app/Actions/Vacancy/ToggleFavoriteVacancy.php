<?php

namespace App\Actions\Vacancy;

use App\Models\Favorite;
use App\Models\User;
use App\Models\Vacancy;
use Lorisleiva\Actions\Concerns\AsAction;

class ToggleFavoriteVacancy
{
    use AsAction;

    public function handle(User $user, Vacancy $vacancy): bool|null
    {
        $favorite = Favorite::where(['user_id' => $user->id, 'vacancy_id' => $vacancy->id])->first();
        if ($favorite != null) {
            $favorite->delete();

            return null;
        }
        Favorite::create(['user_id' => $user->id, 'vacancy_id' => $vacancy->id]);

        return true;
    }

    public function asController(User $user, Vacancy $vacancy): bool|null
    {
        return $this->handle($user, $vacancy);
    }

    public function jsonResponse($response)
    {
        if ($response) {
            return response()->json(['message' => 'You Liked this Vacancy']);
        }

            return response()->json(['message' => 'You unliked this Vacancy']);

    }
}
