<?php

namespace App\Actions\Vacancy;

use App\Http\Resources\FavoriteResource;
use App\Http\Resources\FavoriteResourceCollection;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetUserFavoriteVacancies
{
    use AsAction;

    public function handle()
    {
        return auth('sanctum')->user()->favorites;
    }
    public function asController()
    {
        return $this->handle();
    }
    public function jsonResponse(Collection $favorite): JsonResponse
    {
        return response()->json(['favorites' => new FavoriteResourceCollection($favorite)]);
    }
}
