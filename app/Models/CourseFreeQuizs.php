<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseFreeQuizs extends Model
{
    protected $table = 'course_free_quizs';

    protected $fillable = [
        'quiz',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct_answer',
        'course_free_id',
    ];
}
