<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckboxAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['selectionId','answerId'];

    public function basicanswer(){
        return $this->belongsTo(BasicAnswer::class, 'answerId', 'id');
    }

    public function selection(){
        return $this->belongsTo(Selection::class, 'selectionId');
    }
}
