<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicSurvey extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function user(){
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function questions(){
        return $this->morphMany(Question::class, 'questionable');
    }

    public function basicanswers(){
        return $this->morphMany(BasicAnswer::class, 'surveyable');
    }

}
