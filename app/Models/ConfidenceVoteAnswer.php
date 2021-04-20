<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfidenceVoteAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['answerId'];

    public function basicanswer(){
        return $this->belongsTo(BasicAnswer::class, 'answerId', 'id');
    }
}
