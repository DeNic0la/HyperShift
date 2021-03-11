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

    public function terminfrages(){
        return $this->hasMany(TerminFrage::class, 'surveyId');
    }

}
