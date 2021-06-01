<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DocResource extends Model
{
    protected $table = 'doc_resources';

    protected $fillable = [
        'doc_id',
        'name',
        'slug',
        'info',
        'description',
        'url_source',
        'code',
        'price',
    ];
}
