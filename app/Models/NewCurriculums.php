<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class NewCurriculums extends Model
{
    protected $table = 'new_curriculums';

    protected $fillable = [
        'page_id',
        'name',
        'description',
        'link',
        'code',
    ];
}
