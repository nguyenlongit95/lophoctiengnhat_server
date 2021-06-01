<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseThematics extends Model
{
    protected $table = 'course_thematics';

    protected $fillable = [
        'page_id',
        'name',
        'slug',
        'info',
        'video_link',
        'description',
        'code',
        'video_type',
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
    public function courseThematicSources()
    {
        return $this->hasMany('App\Models\CourseThematicSources', 'course_thematic_id', 'id');
    }
}
