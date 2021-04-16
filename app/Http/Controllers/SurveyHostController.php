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
        if ($Key !== null && Cache::get($Key) == $bluePrintString){
            Cache::put($Key,$bluePrintString,18); //TODO Change to 1800
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
        Cache::put($Key,$bluePrintString,18); //TODO Change to 1800
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

    public function join(Request $request,$Key){//PHP Session id
        $bluePrintString = Cache::get($Key);
        if (!Cache::has($bluePrintString."people")){
            abort(404);
        }
        Cache::increment($bluePrintString.'people');
        $BluePrint = BluePrint::where('url_string', '=', $bluePrintString)->with('user')->first();
        return Inertia::render('LiveSurvey/Container',array(
            'Key' => $Key,
            'BluePrint' => $BluePrint
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
        return $request;
        $validated = $request->validate([
            'Key' => 'required',
            'lastKnownQuestion' => 'integer',
        ]);
        $bluePrintString = Cache::get($validated['Key']);
        if (!Cache::has($bluePrintString."question")){
            abort(404);
        }
        $currentQuestion = Cache::get($bluePrintString."question");
        if ($currentQuestion == $validated['lastKnownQuestion'])
            return array('newQuestion' => false);
        $Key = $validated['Key'];
        return Cache::remember('question'+$currentQuestion+$Key,20,function () use ($bluePrintString,$currentQuestion,$Key) {
           $Questions = Cache::remember('questions'+$Key,18, function () use ($bluePrintString) {//TODO Change the Numbers
               return collect(BluePrint::where('url_string', '=', $bluePrintString)->with('questions')->with('questions.terminquestion')->with('questions.terminquestion.termins')->first()->questions());
           });
           dd($Questions);
        });

    }

}
