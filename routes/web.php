<?php

use App\Http\Controllers\SurveyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Dashboard');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    abort(404);
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/create', function () {
    return Inertia::render('CreateBasicSurvey/CreateSurvey');
})->name('create');
Route::get('/survey/fill/{surveyString}', [SurveyController::class , 'fill'])->name('fill');

Route::middleware('auth:sanctum')->post('/createSurvey',[SurveyController::class , 'create']);

Route::get('/getSurvey',[SurveyController::class , 'getSurvey']);

