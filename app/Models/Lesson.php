<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
