<?php

namespace App\Actions\Application;

use App\Http\Resources\ApplicationResource;
use App\Models\Application;
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

    public function jsonResponse(Application $application): ApplicationResource
    {
        return new ApplicationResource($application);
    }
}
