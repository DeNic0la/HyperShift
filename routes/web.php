<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyHostController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'show']);

Route::get('/dashboard', function () {
    abort(404);
})->name('dashboard');//TODO REMOVE This

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


//Host
Route::get('/host/{bluePrintString}', [SurveyHostController::class , 'start'])->name('host');
Route::get('/getBluePrint',[SurveyHostController::class , 'getBluePrint'])->name('bpInfo');
Route::get('/runLobby',[SurveyHostController::class , 'runLobby'])->name('runLobby');
Route::post('/host/update',[SurveyHostController::class , 'updateQuestion'])->name('updateQuestion');
//Join
Route::get('/join/{Key}', [SurveyHostController::class , 'join'])->name('join');
Route::get('/leave/{Key}', [SurveyHostController::class , 'leave'])->name('leave');
Route::get('/live/update', [SurveyHostController::class , 'update'])->name('update');
Route::get('/live/question', [SurveyHostController::class , 'question'])->name('question');

//Home
Route::get('/validateKey',[HomeController::class , 'validateJoinKey'])->name('validateKey');

