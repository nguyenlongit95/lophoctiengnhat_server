<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CourseLevel extends Model
{
    protected $table = 'course_levels';

    protected $fillable = [
        'page_id',
        'name',
        'slug',
        'info',
        'description',
        'code',
        'video_type',
        'video_link',
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
    public function courseLevelSource()
    {
        return $this->hasMany('App\Models\CourseLevelSource', 'course_level_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseLevelQuizs()
    {
        return $this->hasMany('App\Models\CourseLevelQuizs', 'course_level_id', 'id');
    }
}
