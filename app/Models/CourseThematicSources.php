<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseThematicSources extends Model
{
    protected $table = 'course_thematic_sources';

    protected $fillable = [
        'course_thematic_id',
        'name',
        'slug',
        'info',
        'description',
    ];
}
