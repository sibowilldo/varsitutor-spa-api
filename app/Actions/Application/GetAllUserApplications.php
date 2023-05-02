<?php

namespace App\Actions\Application;

use App\Http\Resources\ApplicationResourceCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllUserApplications
{
    use AsAction;

    public function handle()
    {
        // ...
    }

    public function asController(): Collection
    {
        return auth('sanctum')->user()->applications;
    }

    public function jsonResponse(Collection $applications): JsonResponse
    {
        return response()->json(['applications' => new ApplicationResourceCollection($applications)]);
    }
}
