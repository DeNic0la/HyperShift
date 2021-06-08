<?php

namespace App\Http\Controllers;

use App\Models\BasicSurvey;
use App\Models\BluePrint;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class SurveyHostController extends Controller
{
    public function start(Request $request, $bluePrintString){
        $Key = Cookie::get($bluePrintString);
        if ($Key !== null && Cache::get($Key) === $bluePrintString){
            Cache::put($Key,$bluePrintString,1800);
            Cache::put($bluePrintString."question",0,1800);
            Cache::put($bluePrintString."people",0,1800);
            return Inertia::render('Host/Container', array('join_key' => $Key));
        }

        $BluePrint = BluePrint::where('url_string', '=', $bluePrintString);
        if ($BluePrint->count() == 0){
            abort(404);
        }

        if ($BluePrint->first()->user()->first() !== null && $BluePrint->first()->user()->first()->id !== Auth::id()){
            abort(403);
        }

        do{
            $Key = mt_rand(100000, 999999);
        }while (Cache::has($Key));

        $BA = BluePrint::where('url_string', '=', $bluePrintString)->first()->basicanswers()->get();
        foreach ($BA as $basicAnswer){
            $basicAnswer->terminanswers()->delete();
        }
        BluePrint::where('url_string', '=', $bluePrintString)->first()->basicanswers()->delete();

        Cache::put($Key,$bluePrintString,1800);
        Cache::put($bluePrintString."question",0,1800);
        Cache::put($bluePrintString."people",0,1800);
        Cookie::queue($bluePrintString,$Key,120);

        return Inertia::render('Host/Container', array('join_key' => $Key));
    }
    public function getBluePrint(Request $request){
        $validated = $request->validate([
            'bluePrintString' => 'required',
        ]);
        return BluePrint::where('url_string', '=', $validated['bluePrintString'])->with('user')->with('questions')->with('questions.terminquestion')->with('questions.terminquestion.termins')->first();
    }
    public function runLobby(Request $request){
        $validated = $request->validate([
            'bluePrintString' => 'required',
        ]);
        $bluePrintString = $validated['bluePrintString'];
        $Key = Cookie::get($bluePrintString);
        if (Cache::get($Key) !== $bluePrintString||!Cache::has($bluePrintString."question"))
            abort(404);
        Cache::put($Key,$bluePrintString,100);
        return Cache::get($bluePrintString."people");
    }

    public function endLobby(Request $request){
        $validated = $request->validate([
            'bluePrintString' => 'required',
        ]);
        $bluePrintString = $validated['bluePrintString'];
        $Key = Cookie::get($bluePrintString);
        if (Cache::get($Key) !== $bluePrintString||!Cache::has($bluePrintString."question"))
            abort(404);

        Cache::forget($Key);
        Cache::forget($bluePrintString);
        Cache::forget($bluePrintString."people");
        Cache::forget($bluePrintString."question");
        Cache::put($Key,'end',10);

    }

    public function join(Request $request,$Key){
        $bluePrintString = Cache::get($Key);
        if (!Cache::has($bluePrintString."people")){
            abort(404);
        }
        Cache::increment($bluePrintString.'people');
        $BluePrint = BluePrint::where('url_string', '=', $bluePrintString)->with('user')->first();
        return Inertia::render('LiveSurvey/Container',array(
            'Key' => $Key,
            'BluePrint' => $BluePrint,
            'AmountOfQuestions' => $BluePrint->questions()->count()
        ));
    }
    public function leave(Request $request,$Key){
        $bluePrintString = Cache::get($Key);
        if (!Cache::has($bluePrintString."people")){
            abort(404);
        }
        Cache::decrement($bluePrintString.'people');
    }
    public function update(Request $request){
        $validated = $request->validate([
            'Key' => 'required',
        ]);
        $bluePrintString = Cache::get($validated['Key']);
        if (!Cache::has($bluePrintString."question")){
            abort(404);
        }
        Cookie::queue($bluePrintString,$validated['Key'],120);
        return Cache::get($bluePrintString."question");
    }
    public function updateQuestion(Request $request){
        $validated = $request->validate([
            'bluePrintString' => 'required',
            'questionNumber' => 'required|integer',
        ]);
        $bluePrintString = $validated['bluePrintString'];
        if (!Cache::has($bluePrintString."question")){
            abort(404);
        }
        Cache::put($bluePrintString."question",$validated['questionNumber'],1800);
        return response(null,200);
    }
    public function question(Request $request){
        $validated = $request->validate([
            'Key' => 'required',
            'lastKnownQuestion' => 'integer',
        ]);
        $bluePrintString = Cache::get($validated['Key']);
        if ($bluePrintString === 'end'){
            return array('surveyIsFinished' => 'true');
        }
        if (!Cache::has($bluePrintString."question")){
            abort(404,array('surveyIsFinished' => true));
        }
        $currentQuestion = Cache::get($bluePrintString."question");
        if ($currentQuestion == $validated['lastKnownQuestion'])
            return array('newQuestion' => false);
        $Key = $validated['Key'];
        $Question = Cache::remember('question' . strval($currentQuestion) . strval($Key),20,function () use ($bluePrintString,$currentQuestion,$Key) {
           $Questions = Cache::remember('questions'.$Key,18, function () use ($bluePrintString) {//TODO Change the Numbers
               return collect(BluePrint::where('url_string', '=', $bluePrintString)->first()->questions()->with('terminquestion')->with('terminquestion.termins')->get());
           });
           return $Questions->getNth($currentQuestion-1);//-1 Cause they start at 1
        });
        return array('newQuestion' => true,'question' => $Question, 'currentQuestion' => $currentQuestion);

    }
    public function answer(Request $request){
        $validated = $request->validate([
            'answers' => 'required',
            'Key' => 'required|integer',
            'questionNumber' => 'required|integer'
        ]);
        $Key = $validated['Key'];
        $bluePrintString = Cache::get($Key);
        if (!Cache::has($bluePrintString."question")){
            abort(404);
        }



        $BluePrint = BluePrint::where('url_string', '=', $bluePrintString)->first();
        $Answer = $BluePrint->basicanswers()->create([
            'fillerId' => Auth::id(),
            'fillerName' => '',
        ]);
        foreach ($validated['answers'] as $item){
            $Answer->terminanswers()->create([
                'terminId' => $item
            ]);
        }


        return $request;
    }

}
