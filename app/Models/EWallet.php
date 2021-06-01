<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EWallet extends Model
{
    protected $table = 'e_wallet';

    protected $fillable = [
        'user_id',
        'amount',
        'total_charge',
        'note',
        'status', // 0 locked, 1 unlocked
    ];

    /**
     * Function relationship to table user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function e_wallet_detail()
    {
        return $this->hasMany('\App\Models\EWalletDetail', 'e_wallet_id', 'id');
    }
}
