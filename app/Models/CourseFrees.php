<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseFrees extends Model
{
    protected $table = 'course_frees';

    protected $fillable = [
        'page_id',
        'name',
        'slug',
        'info',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseFreeSource()
    {
        return $this->hasMany('App\Models\CourseFreeSources', 'course_free_id', 'id');
    }
}
