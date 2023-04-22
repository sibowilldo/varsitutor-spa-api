<?php

namespace App\Actions\Application;

use App\Http\Resources\ApplicationResourceCollection;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllUserApplications
{
    use AsAction;

    public function handle()
    {
        // ...
    }

    public function asController(User $user): Collection
    {
        return $user->applications;
    }

    public function jsonResponse(Collection $applications): ApplicationResourceCollection
    {

        return new ApplicationResourceCollection($applications);
    }
}
