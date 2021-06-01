<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseOnlineSource extends Model
{
    protected $table = 'course_online_source';

    protected $fillable = [
        'course_online_id', 'class_name', 'url_source_class', 'state', 'sort'
    ];
}
