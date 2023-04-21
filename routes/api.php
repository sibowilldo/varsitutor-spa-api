<?php

use App\Actions\Application\CreateNewApplication;
use App\Actions\MobileAuth\AuthenticateUser;
use App\Actions\MobileAuth\RegisterNewUser;
use App\Actions\Vacancy\ApproveVacancy;
use App\Actions\Vacancy\RejectVacancy;
use App\Actions\Vacancy\ToggleFavoriteVacancy;
use App\Actions\Vacancy\ViewSingleVacancy;
use App\Actions\Vacancy\ViewVacancyList;
use App\Http\Resources\VacancyResource;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', RegisterNewUser::class);
Route::post('/auth/token', AuthenticateUser::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());

    Route::prefix('applications')->group(function (){
        Route::post('/', CreateNewApplication::class);
    });
});

Route::get('/vacancy/paginated', function () {
    return response()->json(['vacancies' => VacancyResource::collection(Vacancy::paginate())]);
});

Route::prefix('vacancies')->group(function () {
    Route::get('/', ViewVacancyList::class);
    Route::get('/{vacancy}', ViewSingleVacancy::class);
    Route::patch('/{vacancy}/approve', ApproveVacancy::class);
    Route::patch('/{vacancy}/reject', RejectVacancy::class);
});

Route::prefix('users')->group(function () {
    Route::post('/{user}/vacancies/{vacancy}/favorite', ToggleFavoriteVacancy::class);
});
