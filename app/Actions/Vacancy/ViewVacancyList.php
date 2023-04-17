<?php

namespace App\Actions\Vacancy;

use App\Http\Resources\VacancyResource;
use App\Models\Status;
use App\Models\Vacancy;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Lorisleiva\Actions\Concerns\AsAction;

class ViewVacancyList
{
    use AsAction;

    public function handle(): AnonymousResourceCollection
    {
       $statuses = Status::whereIn('name', ['approved'])
           ->where('model_type', 'vacancies')
           ->get()
           ->pluck('id')
           ->toArray();

        return VacancyResource::collection(Vacancy::orderByDesc('updated_at')
            ->whereIn('status_id', $statuses)
            ->paginate());
    }

    public function jsonResponse()
    {
        return response()->json([$this->handle()]);
    }
}
