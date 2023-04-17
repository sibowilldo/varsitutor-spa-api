<?php

namespace App\Actions\Vacancy;

use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Lorisleiva\Actions\Concerns\AsAction;

class ViewSingleVacancy
{
    use AsAction;

    public function handle()
    {

    }

    public function asController(Vacancy $vacancy)
    {
        return $vacancy;
    }

    public function jsonResponse(Vacancy $vacancy): VacancyResource
    {
        return new VacancyResource($vacancy);
    }
}
