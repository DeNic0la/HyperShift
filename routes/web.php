<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyHostController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
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


Route::get('/', [HomeController::class , 'show'])->name('dashboard');
Route::get('/validateSurvey', [HomeController::class , 'validateJoinCode']);

Route::get('/dashboard', function () {
    abort(404);
});

Route::get('/result', [HomeController::class , 'result'])->name('result');

Route::get('/create', function () {
    return Inertia::render('CreateBasicSurvey/CreateSurvey');
})->name('create');
Route::get('/survey/fill/{surveyString}', [SurveyController::class , 'fill'])->name('fill');

Route::post('/createSurvey',[SurveyController::class , 'create']);
Route::post('/createBlueprint',[SurveyController::class , 'createBluePrint']);

Route::get('/getSurvey',[SurveyController::class , 'getSurvey']);


Route::post('/answerSurvey',[SurveyController::class , 'answerSurvey']);


Route::middleware(['auth:sanctum', 'verified'])->get('/MySurveys', function () {
    return Inertia::render('MySurveys/MySurveys');
})->name('MySurveys');

Route::get('/getUserSurveys',[SurveyController::class , 'getUserSurveys']);

Route::get('/survey/results/{surveyString}', [SurveyController::class , 'results'])->name('results');

Route::get('/getResults',[SurveyController::class , 'getResults']);

//Host
Route::get('/host/{bluePrintString}', [SurveyHostController::class , 'start'])->name('host');
Route::get('/getBluePrint',[SurveyHostController::class , 'getBluePrint'])->name('bpInfo');
Route::get('/runLobby',[SurveyHostController::class , 'runLobby'])->name('runLobby');

