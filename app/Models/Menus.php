<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'parent_id',
        'count_child',
        'status',
        'sort'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany('App\Models\Pages', 'menu_id', 'id');
    }
}
