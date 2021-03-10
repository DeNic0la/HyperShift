<?php

namespace App\Http\Controllers;

use App\Models\BasicSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $survey = BasicSurvey::create([
            'owner_id' => Auth::id(),
            'survey_name' => $validated['name'],
        ]);
        $request->session()->flash('flash.banner', 'Yay it works!');
        $request->session()->flash('flash.bannerStyle', 'success');
        return response($survey,201);

    }
}
