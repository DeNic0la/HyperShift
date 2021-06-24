<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckboxQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function question(){
        return $this->hasOne(Question::class, 'Id', 'questionId');
    }

    public function selections(){
        return $this->hasMany(Selection::class, 'checkboxQuestionId');
    }
}
