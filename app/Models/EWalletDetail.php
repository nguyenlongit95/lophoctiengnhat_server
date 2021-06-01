<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EWalletDetail extends Model
{
    protected $table = 'e_wallet_detail';

    protected $fillable = [
        'e_wallet_id',
        'price',
        'time_charge',
        'code_charge',
        'status',   // 0: mua khoa hoc 1: nap them tien
    ];
}
