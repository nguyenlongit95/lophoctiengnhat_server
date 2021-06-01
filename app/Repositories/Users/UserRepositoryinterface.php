<?php


namespace App\Repositories\Users;


interface UserRepositoryinterface
{
    /**
     * @param $user
     * @return mixed
     */
    public function getWallet($user);

    /**
     * @param $eWallet
     * @return mixed
     */
    public function joinCourse($eWallet);
}
