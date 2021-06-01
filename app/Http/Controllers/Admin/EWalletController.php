<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\EWalletHelper;
use Illuminate\Http\Request;

class EWalletController extends Controller
{
    /**
     * Controller function render view list wallet
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(Request $request)
    {
        $eWallet = app()->make(EWalletHelper::class)->listWallet();
        return view('admin.pages.e_wallet.index', compact('eWallet'));
    }

    /**
     * Controller function render view index log
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function listLogs(Request $request)
    {
        $logs = app()->make(EWalletHelper::class)->listLogs();
        return view('admin.pages.e_wallet.logs', compact('logs'));
    }

    /**
     * Controller function find wallet and render view wallet
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function show(Request $request, $id)
    {
        $wallet = app()->make(EWalletHelper::class)->showWallet($id);
        if (!$wallet) {
            return redirect('/admin/e-wallet/index');
        }

        return view('admin.pages.e_wallet.show', compact('wallet', 'id'));
    }

    /**
     * Controller function update an wallet
     *
     * @param Request $request
     * @param int $id of wallet
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(Request $request, $id)
    {
        $param = $request->all();
        $param['id'] = $id;
        $update = app()->make(EWalletHelper::class)->updateWallet($param);
        if ($update) {
            return redirect()->back()->with('status', config('langVN.update_success'));
        }

        return redirect()->back()->with('status', config('langVN.update_failed'));
    }
}
