<?php

namespace App\Http\Controllers;

use App\Models\BasicSurvey;
use App\Models\TerminFrage;
use App\Models\Termin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SurveyController extends Controller
{
    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'questions' => 'required',
        ]);
        //TODO REMOVE THIS, THIS IS ONLY DEV
        if (app()->environment(['local','dev'])){
            if ($validated['name'] == 'DoError'){
                return response('Error for Development',200);
            }
        }

        $randomString = "";
        do {
            $randomString = Str::random(15);
        }while(BasicSurvey::where('url_string', '=', $randomString)->count() != 0);
        $survey = BasicSurvey::create([
            'owner_id' => Auth::id(),
            'survey_name' => $validated['name'],
            'url_string' => $randomString,
        ]);

        $Questions = $request['questions'];
        foreach ($Questions as $question){
            if ($question['type'] == 1){
                $toSave= new TerminFrage([
                    'name' => $question['name']
                ]);
                $QuestionInDB = $survey->terminfrages()->save($toSave);
                foreach ($question['options'] as $option) {
                    if ($option['datetime'] == null || $option['duration'] == null){

                    }
                    else{
                        $Termin = new Termin([
                            'time' => $option['datetime'],
                            'duration' => $option['duration']
                        ]);
                        $Termin = $QuestionInDB->termins()->save($Termin);
                    }
                }
            }
        }




        return response($survey,201);

    }
    public function fill(Request $request,$surveyString){
        if (BasicSurvey::where('url_string', '=', $surveyString)->count() == 0){
            abort(404);
        }
        return Inertia::render('AnswerBasicSurvey/Container');
    }
    public function getSurvey(Request $request){
        $validated = $request->validate([
            'surveyString' => 'required',
        ]);
        return BasicSurvey::where('url_string', '=', $validated['surveyString'])->with('user')->with('terminfrages')->with('terminfrages.termins')->first();
    }
    public function answerSurvey(Request $request){
        $validated = $request->validate([
            'answers' => 'required',
            'survey' => 'required',
        ]);
        if (BasicSurvey::where('url_string', '=', $validated['survey'])->count() == 0){
            abort(404);
        }

        $Survey = BasicSurvey::where('url_string', '=', $validated['survey'])->first();


        return 'Helikopter';
    }
}
