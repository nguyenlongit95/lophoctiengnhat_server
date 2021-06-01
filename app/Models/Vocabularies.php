<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Vocabularies extends Model
{
    protected $table = 'vocabularies';

    protected $fillable = [
        'vn_text',
        'jp_text',
        'name',
        'han_tu',
        'han_speck',
        'info',
        'jp_sound',
        'vn_sound',
    ];
}
