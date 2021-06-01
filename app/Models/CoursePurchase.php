<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CoursePurchase extends Model
{
    protected $table = 'course_purchase';

    protected $fillable = [
        'user_id',
        'amount',
        'bue_time',
        'course_code',
    ];
}
