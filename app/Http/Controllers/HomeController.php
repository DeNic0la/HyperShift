<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function show(Request $request){
        return Inertia::render('Dashboard');
    }
    public function validateJoinKey(Request $request){
        $validated = $request->validate([
            'Key' => 'required',
        ]);
        return Cache::has($validated['Key']);
    }

}
