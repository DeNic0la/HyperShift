<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function terminquestion(){
        return $this->hasOne(TerminQuestion::class, 'questionId');
    }

    public function confidencevotequestion(){
        return $this->hasOne(ConfidenceVoteQuestion::class, 'questionId');
    }

    public function checkboxquestion(){
        return $this->hasOne(CheckboxQuestion::class, 'questionId');
    }

    public function questionable(){
        return $this->morphTo();
    }


}
