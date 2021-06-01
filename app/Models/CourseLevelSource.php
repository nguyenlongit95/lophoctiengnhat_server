<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLevelSource extends Model
{
    protected $table = 'course_level_sources';

    protected $fillable = [
        'course_level_id',
        'source',
        'info',
    ];
}
