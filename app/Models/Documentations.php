<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Documentations extends Model
{
    protected $table = 'documentations';

    protected $fillable = [
        'name',
        'slug',
        'info',
        'description',
        'code',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function docResource()
    {
        return $this->hasMany('App\Models\DocResource', 'doc_id', 'id');
    }
}
