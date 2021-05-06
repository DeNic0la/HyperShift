<?php

namespace App\Http\Controllers;

use App\Models\BasicAnswer;
use App\Models\BasicSurvey;
use App\Models\BluePrint;
use App\Models\ConfidenceVoteQuestion;
use App\Models\Question;
use App\Models\TerminAnswer;
use App\Models\TerminQuestion;
use App\Models\Termin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SurveyController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'questions' => 'required',
        ]);
        //TODO REMOVE THIS, THIS IS ONLY DEV
        if (app()->environment(['local', 'dev'])) {
            if ($validated['name'] == 'DoError') {
                return response('Error for Development', 200);
            }
        }

        $randomString = "";
        do {
            $randomString = Str::random(15);
        } while (BluePrint::where('url_string', '=', $randomString)->count() + BasicSurvey::where('url_string', '=', $randomString)->count() != 0);
        $survey = BasicSurvey::create([
            'owner_id' => Auth::id(),
            'survey_name' => $validated['name'],
            'url_string' => $randomString,
        ]);

        $Questions = $request['questions'];

        foreach ($Questions as $question) {
            $BaseQuestion = $survey->questions()->create();
            if ($question['type'] == 1) {
                $toSave = new TerminQuestion([
                    'name' => $question['name']
                ]);
                $QuestionInDB = $BaseQuestion->terminquestion()->save($toSave);
                foreach ($question['options'] as $option) {
                    if ($option['datetime'] == null || $option['duration'] == null) {

                    } else {
                        $Termin = new Termin([
                            'time' => $option['datetime'],
                            'duration' => $option['duration']
                        ]);
                        $Termin = $QuestionInDB->termins()->save($Termin);
                    }
                }
            } elseif ($question['type'] == 2) {
                foreach ($question['options'] as $option) {
                    $ConfidenceVoteQuestion = new ConfidenceVoteQuestion([
                        'name' => $question['name'],
                        'maxValue' => $option['maxValue']
                    ]);
                    $ConfidenceQuestionInDB = $BaseQuestion->confidencevotequestion()->save($ConfidenceVoteQuestion);
                }
            }
        }


        return response($survey, 201);

    }

    public function createBluePrint(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'questions' => 'required',
        ]);
        //TODO REMOVE THIS, THIS IS ONLY DEV
        if (app()->environment(['local', 'dev'])) {
            if ($validated['name'] == 'DoError') {
                return response('Error for Development', 200);
            }
        }

        $randomString = "";
        do {
            $randomString = Str::random(15);
        } while (BluePrint::where('url_string', '=', $randomString)->count() + BasicSurvey::where('url_string', '=', $randomString)->count() != 0);
        $survey = BluePrint::create([
            'owner_id' => Auth::id(),
            'survey_name' => $validated['name'],
            'url_string' => $randomString,
        ]);

        $Questions = $request['questions'];
        foreach ($Questions as $question) {
            $BaseQuestion = $survey->questions()->create();
            if ($question['type'] == 1) {
                $toSave = new TerminQuestion([
                    'name' => $question['name']
                ]);
                $QuestionInDB = $BaseQuestion->terminquestion()->save($toSave);
                foreach ($question['options'] as $option) {
                    if ($option['datetime'] == null || $option['duration'] == null) {

                    } else {
                        $Termin = new Termin([
                            'time' => $option['datetime'],
                            'duration' => $option['duration']
                        ]);
                        $Termin = $QuestionInDB->termins()->save($Termin);
                    }
                }
            }
        }


        return response($survey, 201);
    }

    public function fill(Request $request, $surveyString)
    {
        if (BasicSurvey::where('url_string', '=', $surveyString)->count() == 0) {
            abort(404);
        }
        return Inertia::render('AnswerBasicSurvey/Container');
    }

    public function getSurvey(Request $request) {
        $validated = $request->validate([
            'surveyString' => 'required',
        ]);
        return BasicSurvey::where('url_string', '=', $validated['surveyString'])->with('user')
        ->with('questions')->with('questions.terminquestion')->with('questions.terminquestion.termins')->with('questions.confidencevotequestion')->first();
    }

    public function answerSurvey(Request $request){
        $validated = $request->validate([
            'confidenceAnswers' => 'required',
            'terminAnswers' => 'required',
            'survey' => 'required',
            'name' => ''
        ]);
        if (BasicSurvey::where('url_string', '=', $validated['survey'])->count() == 0){
            abort(404);
        }

        $Survey = BasicSurvey::where('url_string', '=', $validated['survey'])->first();
        $Answer = $Survey->basicanswers()->create([
            'fillerId' => Auth::id(),
            'fillerName' => $validated['name'] == "" ? null:$validated['name'],
        ]);
        foreach ($validated['terminAnswers'] as $terminAnswer) {
                $Answer->terminanswers()->create([
                    'terminId' => $terminAnswer
                ]);
        }
        foreach ($validated['confidenceAnswers'] as $confidenceAnswer) {
            $Answer->confidencevoteanswer()->create([
                'value' => $confidenceAnswer
            ]);
        }
        return $request;

    }
    public function getUserSurveys(){
        $userId = Auth::id();
        return BasicSurvey::where('owner_id', '=', $userId)->get();
    }

    public function results(Request $request,$surveyString){
        if (BasicSurvey::where('url_string', '=', $surveyString)->count() == 0){
            abort(404);
        }
        return Inertia::render('SurveyResults/Container');
    }

    public function getResults(Request $request){
        $validated = $request->validate([
            'surveyString' => 'required',
        ]);
        return BasicSurvey::where('url_string', '=', $validated['surveyString'])->with('user')->with('questions')->with('questions.terminquestion')->with('questions.terminquestion.termins')
            ->with('questions.confidencevotequestion')
            ->with('basicanswers')
            ->with('basicanswers.user')->with('basicanswers.terminanswers')
            ->with('basicanswers.terminanswers.termin')
            ->with('basicanswers.confidencevoteanswer')
            ->first();
    }
}
