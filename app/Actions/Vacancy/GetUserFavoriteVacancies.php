<?php

namespace App\Actions\Vacancy;

use App\Http\Resources\FavoriteResource;
use App\Http\Resources\FavoriteResourceCollection;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserFavoriteVacancies
{
    use AsAction;

    public function authorize(): Response
    {
        return auth('sanctum')->id() === (int)request()->user
            ? Response::allow()
            : Response::deny('Access not granted!');
    }

    public function asController(Request $request)
    {
        $user = User::where('id', request()->user)->first();
        return $this->handle($user);
    }

    public function handle(User $user)
    {
        return $user->favorites;
    }

    public function jsonResponse(Collection $favorite): FavoriteResourceCollection
    {
        return new FavoriteResourceCollection($favorite);
    }
}
