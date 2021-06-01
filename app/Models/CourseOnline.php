<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseOnline extends Model
{
    /**
     * @var string
     */
    protected $table = 'course_onlines';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'page_id',
        'name',
        'description',
        'link',
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pages()
    {
        return $this->hasOne('App\Models\Pages', 'page_id', 'id');
    }
}
