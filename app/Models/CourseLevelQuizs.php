<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLevelQuizs extends Model
{
    protected $table = 'course_level_quizs';

    protected $fillable = [
        'quiz',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct_answer',
        'course_level_id',
    ];
}
