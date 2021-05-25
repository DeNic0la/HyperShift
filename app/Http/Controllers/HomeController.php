<?php

namespace App\Http\Controllers;

use App\Models\BasicSurvey;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function show(Request $request){
        return Inertia::render('Dashboard');
    }
    public function validateJoinCode(Request $request){
        $validated = $request->validate([
            'Key' => 'required',
        ]);
        $SurveyString = $validated['Key'];
        return BasicSurvey::where('url_string', '=', $SurveyString)->count() === 1;
    }
    public function result(Request $request){
        return Inertia::render('Result/Container');
    }
}
