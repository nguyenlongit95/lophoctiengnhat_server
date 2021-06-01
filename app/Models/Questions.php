<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'page_id',
        'name',
        'slug',
        'info',
        'type',
        'description',
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pages()
    {
        return $this->hasOne('App\Models\Pages', 'page_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function questionDetails()
    {
        return $this->hasOne('App\Models\QuestionDetails', 'question_id', 'id');
    }
}
