<?php

namespace App\Repositories\Users;

use App\Models\EWallet;
use App\User;
use App\Repositories\Eloquent\EloquentRepository;
use Illuminate\Support\Facades\DB;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryinterface
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * SQL function get e-wallet of users
     *
     * @param object $user
     * @return mixed
     */
    public function getWallet($user)
    {
        return EWallet::where('user_id', $user->id)->where('status', 1)->with(['e_wallet_detail' => function ($query) {
            $query->join('e_wallet_logs', 'e_wallet_detail.id', 'e_wallet_logs.e_wallet_detail_id');
        }])->first();
    }

    /**
     * Function check code charge and join course
     *
     * @param object $eWallet
     * @return mixed
     */
    public function joinCourse($eWallet)
    {
        if (!empty($eWallet->e_wallet_detail)) {
            foreach ($eWallet->e_wallet_detail as $value) {
                $courseOnline = DB::table('course_onlines')->where('code', $value->code_charge)->first();
                if (!empty($courseOnline)) {
                    $value->course_name = $courseOnline->name;
                    $value->course_id = $courseOnline->id;
                }
                $courseLevel = DB::table('course_levels')->where('code', $value->code_charge)->first();
                if (!empty($courseLevel)) {
                    $value->course_name = $courseLevel->name;
                    $value->course_id = $courseLevel->id;
                }
            }

            return $eWallet;
        }

        return null;
    }
}
