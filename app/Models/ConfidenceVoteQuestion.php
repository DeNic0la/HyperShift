<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfidenceVoteQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'maxValue'];

    public function question(){
        return $this->hasOne(Question::class, 'Id', 'questionId');
    }

    public function confidencevoteanswer(){
        return $this->hasMany(ConfidenceVoteAnswer::class, 'questionId', 'id');
    }

}
