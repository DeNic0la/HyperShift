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


Route::get('/result', [HomeController::class , 'result'])->name('result');

Route::get('/create', function () {
    return Inertia::render('CreateBasicSurvey/CreateSurvey');
})->name('create');
Route::get('/survey/fill/{surveyString}', [SurveyController::class , 'fill'])->name('fill');

Route::post('/createSurvey',[SurveyController::class , 'create'])->name('createBasicSurvey');
Route::post('/createBlueprint',[SurveyController::class , 'createBluePrint'])->name('createBluePrint');

Route::get('/getSurvey',[SurveyController::class , 'getSurvey'])->name('getBasicSurvey');


Route::post('/answerSurvey',[SurveyController::class , 'answerSurvey'])->name('answerBasicSurvey');


Route::middleware(['auth:sanctum', 'verified'])->get('/MySurveys', function () {
    return Inertia::render('MySurveys/MySurveys');
})->name('MySurveys');

Route::get('/getUserSurveys',[SurveyController::class , 'getUserSurveys']);

Route::get('/survey/results/{surveyString}', [SurveyController::class , 'results'])->name('results');

Route::get('/getResults',[SurveyController::class , 'getResults']);

//Host
Route::get('/getBluePrint',[SurveyHostController::class , 'getBluePrint'])->name('bpInfo');
Route::get('/runLobby',[SurveyHostController::class , 'runLobby'])->name('runLobby');
Route::post('/host/update',[SurveyHostController::class , 'updateQuestion'])->name('updateQuestion');
Route::post('/host/end',[SurveyHostController::class , 'endLobby'])->name('endLobby');
Route::get('/host/result',[SurveyHostController::class , 'result'])->name('getResult');
Route::get('/host/{bluePrintString}', [SurveyHostController::class , 'start'])->name('host');
//Join
Route::get('/join/{Key}', [SurveyHostController::class , 'join'])->name('join');
Route::get('/leave/{Key}', [SurveyHostController::class , 'leave'])->name('leave');
Route::get('/live/update', [SurveyHostController::class , 'update'])->name('update');
Route::get('/live/question', [SurveyHostController::class , 'question'])->name('question');
Route::post('/live/answer', [SurveyHostController::class , 'answer'])->name('answer');

//Home
Route::get('/validateKey',[HomeController::class , 'validateJoinKey'])->name('validateKey');

