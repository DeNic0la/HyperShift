<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminFrage extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function basicsurvey(){
        return $this->belongsTo(BasicSurvey::class, 'surveyId', 'id');
    }
    public function termins(){
        return $this->hasMany(Termin::class, 'terminFrageId');
    }
}
