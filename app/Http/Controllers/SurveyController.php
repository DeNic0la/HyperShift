<?php

namespace App\Http\Controllers;

use App\Models\BasicSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SurveyController extends Controller
{
    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required',
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
        /*
        $request->session()->flash('flash.banner', 'Yay it works!');
        $request->session()->flash('flash.bannerStyle', 'success');*/
        return response($survey,201);

    }
}
