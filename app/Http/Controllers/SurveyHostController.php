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
        if ($BluePrint->first()->user()->first() !== Auth::user()){
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
        if (Cache::get($Key) !== $bluePrintString||Cache::get($bluePrintString."question") !== 0)
            abort(404);
        Cache::put($Key,$bluePrintString,100);
        return Cache::get($bluePrintString."people");
    }

    public function join(Request $request,$Key){
        $bluePrintString = Cache::get($Key);
        if (!Cache::has($bluePrintString."people")){
            abort(404);
        }
        Cache::increment($bluePrintString.'people');
        return Inertia::render('LiveSurvey/Container',array('Key' => $Key));
    }

}
