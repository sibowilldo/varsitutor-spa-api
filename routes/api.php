<?php

use App\Actions\Application\CreateNewApplication;
use App\Actions\Application\GetAllUserApplications;
use App\Actions\Application\ViewSingleApplication;
use App\Actions\MobileAuth\AuthenticateUser;
use App\Actions\MobileAuth\RegisterNewUser;
use App\Actions\Notifications\GetSingleUserNotification;
use App\Actions\Notifications\GetUserAllNotifications;
use App\Actions\Vacancy\ApproveVacancy;
use App\Actions\Vacancy\GetUserFavoriteVacancies;
use App\Actions\Vacancy\RejectVacancy;
use App\Actions\Vacancy\ToggleFavoriteVacancy;
use App\Actions\Vacancy\ViewSingleVacancy;
use App\Actions\Vacancy\ViewVacancyList;
use App\Http\Resources\UserResource;
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
Route::get('/vacancy/paginated', fn()=>response()->json(['vacancies' => VacancyResource::collection(Vacancy::paginate())]));

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user', fn (Request $request) =>  response()->json(['user' => new UserResource($request->user())]));
});

Route::prefix('applications')->group(function (){
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::post('/', CreateNewApplication::class);
        Route::get('/{application}', ViewSingleApplication::class);
    });
});

Route::prefix('users')->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/applications', GetAllUserApplications::class);
        Route::get('/favorites', GetUserFavoriteVacancies::class);
    });
});

Route::prefix('notifications')->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/', GetUserAllNotifications::class);
        Route::get('/{notification}', GetSingleUserNotification::class);
    });
});

Route::prefix('vacancies')->group(function () {
    Route::get('/', ViewVacancyList::class);
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('/{vacancy}', ViewSingleVacancy::class);
        Route::patch('/{vacancy}/approve', ApproveVacancy::class);
        Route::patch('/{vacancy}/reject', RejectVacancy::class);
        Route::post('/{vacancy}/favorite', ToggleFavoriteVacancy::class);
    });
});

