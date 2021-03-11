<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Termin extends Model
{
    use HasFactory;
    protected $fillable = ['time','duration'];

    public function terminfrage(){
        return $this->belongsTo(TerminFrage::class, 'terminFrageId');
    }
}