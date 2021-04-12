<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function question(){
        return $this->hasOne(Question::class, 'Id', 'questionId');
    }
    public function termins(){
        return $this->hasMany(Termin::class, 'terminQuestionId');
    }
}
