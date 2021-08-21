<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function quiz_options()
    {
        return $this->hasMany(QuizOption::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
