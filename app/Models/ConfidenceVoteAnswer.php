<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfidenceVoteAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['answerId', 'value', 'questionId'];

    public function basicanswer(){
        return $this->belongsTo(BasicAnswer::class, 'answerId', 'id');
    }

    public function confidencevotequestion(){
        return $this->belongsTo(ConfidenceVoteQuestion::class, 'questionId', 'id');
    }
}
