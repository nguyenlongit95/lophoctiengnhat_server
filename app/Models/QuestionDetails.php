<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionDetails extends Model
{
    protected $table = 'question_details';

    protected $fillable = [
        'question_id',
        'question',
        'answer1',
        'answer2',
        'answer3',
        'answer4',
        'correct_answer',
    ];
}
