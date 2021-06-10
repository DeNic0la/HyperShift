<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Selection extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function checkboxfrage(){
        return $this->belongsTo(CheckboxQuestion::class, 'checkboxFrageId');
    }
}
