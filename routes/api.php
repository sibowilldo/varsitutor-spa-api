<?php

use App\Http\Resources\VacancyResource;
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

Route::post('/auth/register', \App\Actions\MobileAuth\RegisterNewUser::class);
Route::post('/auth/token', \App\Actions\MobileAuth\AuthenticateUser::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
});

Route::get('/vacancy', function () {
    return response()->json(['vacancies' => VacancyResource::collection(\App\Models\Vacancy::all())]);
});
