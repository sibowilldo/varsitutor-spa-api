<?php

namespace App\Actions\Application;

use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class ViewSingleApplication
{
    use AsAction;

    public function handle()
    {
    }

    public function asController(Application $application): Application
    {
        return $application;
    }

    public function jsonResponse(Application $application): JsonResponse
    {
        return response()->json(['application' => new ApplicationResource($application)]);
    }
}
