<?php

namespace App\Support;

use App\Models\EWallet;
use App\Models\EWalletDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class EWalletHelper
 * @package App\Support
 */
class EWalletHelper
{
    const WALLET_BLOCK = 0;
    const WALLET_UNBLOCK = 1;
    const PAYMENT_METHOD = 0;
    const CHARGE_METHOD = 1;
    const ROLE_CUSTOMER = 2;

    /**
     * SQL function find an e-wallet
     *
     * @param $userId
     * @return mixed
     */
    public function findEWallet($userId)
    {
        return EWallet::where('user_id', $userId)->where('status', 1)->with('e_wallet_detail')->first();
    }

    /**
     * SQL function list all e-wallet and relation ship an wallet
     *
     * @return mixed
     */
    public function listWallet()
    {
        $eWallet = EWallet::join('users', 'e_wallet.user_id', 'users.id')->where('users.role', self::ROLE_CUSTOMER)
            ->select(
                'users.email', 'users.name',
                'e_wallet.id', 'e_wallet.amount', 'e_wallet.total_charge', 'e_wallet.note', 'e_wallet.status'
            )->orderBy('e_wallet.id', 'DESC')->get();
        if (!empty($eWallet)) {
            foreach ($eWallet as $wallet) {
                $wallet->txt_status = $this->_compareStatusWallet($wallet->status);
            }
        }

        return $eWallet;
    }

    /**
     * SQL function list log transaction
     *
     * @return \Illuminate\Support\Collection
     */
    public function listLogs()
    {
        return DB::table('e_wallet_logs')->join('e_wallet_detail', 'e_wallet_logs.e_wallet_detail_id', 'e_wallet_detail.id')
            ->join('e_wallet', 'e_wallet_detail.e_wallet_id', 'e_wallet.id')
            ->join('users', 'e_wallet.user_id', 'users.id')->select(
                'users.name', 'users.email', 'e_wallet_logs.note', 'e_wallet_logs.time_charge',
                'e_wallet_logs.paygate', 'e_wallet_logs.code_charge', 'e_wallet_logs.id', 'e_wallet_detail.price'
            )->get();
    }

    /**
     * Function create an wallet
     *
     * @param array $param: user_id, note
     * @return mixed
     */
    public function createWallet($param)
    {
        try {
            $eWallet = new EWallet();
            $eWallet->user_id = $param['user_id'];
            $eWallet->amount = 0;
            $eWallet->total_charge = 0;
            $eWallet->note = '';
            $eWallet->status = self::WALLET_UNBLOCK;
            $eWallet->save();
            return $eWallet;
        } catch (\Exception $exception) {
            Log::error($exception);
            return null;
        }
    }

    /**
     * SQL Function show wallet and relation ship
     *
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function showWallet($id)
    {
        $wallet = EWallet::with('e_wallet_detail')->find($id);
        if (!empty($wallet)) {
            $wallet->txt_status = $this->_compareStatusWallet($wallet->status);
            $user = $this->_addUserOfWallet($wallet);
            $wallet->name = $user->name;
            $wallet->email = $user->email;
            if (!empty($wallet)) {
                foreach ($wallet->e_wallet_detail as $value) {
                    $value->txt_status = $this->_compareStatusWalletDetail($value->status);
                }
            }
        }

        return $wallet;
    }

    /**
     * Function update amount an e-wallet
     *
     * @param array $param
     * @param object $eWallet
     * @return bool
     */
    public function updateAmount($param, $eWallet)
    {
        DB::beginTransaction();
        try {
            DB::table('e_wallet')->where('id', $eWallet->id)->update([
                'amount' => $eWallet->amount + $param['price']
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

    /**
     * Function sub amount
     *
     * @param array $param
     * @param object $eWallet
     * @return bool
     */
    public function subPenAmount($param, $eWallet)
    {
        DB::beginTransaction();
        try {
            DB::table('e_wallet')->where('id', $eWallet->id)->update([
                'amount' => $eWallet->amount - $param['price']
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

    /**
     * Function update a wallet
     *
     * @param array $param status, note
     * @return bool
     */
    public function updateWallet($param)
    {
        $eWallet = EWallet::find($param['id']);
        if (!$eWallet) {
            return false;
        }
        $eWallet->status = $param['status'];
        $eWallet->note = $param['note'];
        try {
            return $eWallet->update();
        } catch (\Exception $exception) {
            Log::error($exception);
            return false;
        }
    }

    /**
     * Function create transaction to table e-wallet detail
     *
     * @param array $param
     * @return mixed
     */
    public function createTransaction($param)
    {
        $eWalletDetail = new EWalletDetail();
        try {
            DB::beginTransaction();
            $eWalletDetail->e_wallet_id = $param['e_wallet_id'];
            $eWalletDetail->price = $param['price'];
            $eWalletDetail->time_charge = Carbon::now();
            $eWalletDetail->status = $param['status'];  // 0: mua khoa hoc 1: nap them tien
            $eWalletDetail->code_charge = $param['code_charge'];  // 0: mua khoa hoc 1: nap them tien
            $eWalletDetail->save();
            DB::commit();
            return $eWalletDetail;
        } catch (\Exception $exception) {
            Log::error($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * SQL function store log
     *
     * @param array $param
     * @return bool
     */
    public function transactionStoreLog($param)
    {
        return DB::table('e_wallet_logs')->insert([
            'e_wallet_detail_id' => $param['e_wallet_detail_id'],
            'note' => $param['note'],
            'time_charge' => Carbon::now(),
            'paygate' => $param['paygate'],
            'code_charge' => $param['code_charge']
        ]);
    }

    /**
     * Function compare status of wallet
     *
     * @param $status: 0 locked, 1 unlocked
     * @return null
     */
    private function _compareStatusWallet($status)
    {
        if ($status === 1) {
            return 'Hoạt động';
        } else if ($status === 0) {
            return 'Khoá';
        } else {
            return null;
        }
    }

    /**
     * Function compare status of detail wallet
     *
     * @param $status: 0: mua khoa hoc 1: nap them tien
     * @return string|null
     */
    private function _compareStatusWalletDetail($status)
    {
        if ($status === 1) {
            return 'Mua';
        } else if ($status === 0) {
            return 'Nạp thêm';
        } else {
            return null;
        }
    }

    /**
     * Function find user using table e-wallet
     *
     * @param object $wallet
     * @return mixed
     */
    private function _addUserOfWallet($wallet)
    {
        return User::find($wallet->user_id);
    }
}
