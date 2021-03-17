<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['terminId','answerId'];

    public function basicanswer(){
        return $this->belongsTo(BasicAnswer::class, 'answerId', 'id');
    }
    public function termin(){
        return $this->belongsTo(Termin::class, 'terminId');
    }
}
