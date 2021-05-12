<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['fillerId','fillerName'];


    public function surveyable(){
        return $this->morphTo();
    }
/*    public function basicsurvey(){
        return $this->belongsTo(BasicSurvey::class, 'surveyId', 'id');
    }*/
    public function terminanswers(){
        return $this->hasMany(TerminAnswer::class, 'answerId');
    }
    public function user(){
        return $this->belongsTo(User::class, 'fillerId');
    }
}
