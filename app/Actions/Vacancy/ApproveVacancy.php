<?php

namespace App\Actions\Vacancy;

use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class ApproveVacancy
{
    use AsAction;

    private string $message = 'Vacancy Approved';

    public function handle(Vacancy $vacancy): Vacancy
    {
        try {

            $vacancy->approve();

            // TODO: Notify

        } catch (\Exception $e) {
            $this->message = sprintf('%s. { Because %s }', 'System Error! Failed to Approve Vacancy', $e->getMessage());
        }

        return $vacancy;
    }

    public function asController(Vacancy $vacancy): Vacancy
    {
        return $this->handle($vacancy);
    }

    public function jsonResponse(Vacancy $vacancy): JsonResponse
    {
        return response()->json([
            'message' => $this->message,
            'vacancy' => new VacancyResource($vacancy),
        ], 200);
    }
}
