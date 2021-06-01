<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    /**
     * @var string
     */
    protected $table = "pages";

    protected $fillable = [
        'menu_id',
        'name',
        'slug',
        'info',
        'content',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseOnline()
    {
        return $this->hasMany('App\Models\CourseOnline', 'page_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseLevel()
    {
        return $this->hasMany('App\Models\CourseLevel', 'page_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseThematics()
    {
        return $this->hasMany('App\Models\CourseThematics', 'page_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courseFrees()
    {
        return $this->hasMany('App\Models\CourseFrees', 'page_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Models\Questions', 'page_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function menus()
    {
        return $this->hasOne('App\Models\Menus', 'menu_id', 'id');
    }
}
