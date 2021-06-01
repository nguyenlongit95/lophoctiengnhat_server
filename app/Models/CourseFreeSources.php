<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseFreeSources extends Model
{
    protected $table = 'course_free_sources';

    protected $fillable = [
        'course_free_id',
        'type',
        'info',
        'description',
    ];

}
