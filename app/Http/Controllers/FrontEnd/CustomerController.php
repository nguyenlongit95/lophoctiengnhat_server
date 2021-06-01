<?php

namespace App\Http\Controllers\FrontEnd;

use App\Factory\Paygates\PayGateFactory;
use App\Http\Controllers\Controller;
use App\Models\Paygate;
use App\Repositories\Pages\PagesRepositoryInterface;
use App\Repositories\QuestionDetails\QuestionDetailsRepositoryInterface;
use App\Repositories\Questions\QuestionsRepositoryInterface;
use App\Repositories\Users\UserRepositoryinterface;
use App\Support\EWalletHelper;
use App\Support\ResponseHelper;
use App\Support\UploadFileHelper;
use App\Validations\Validation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * @var UserRepositoryinterface
     */
    private $userRepository;

    /**
     * CustomerController constructor.
     * @param UserRepositoryinterface $userRepository
     */
    public function __construct(
        UserRepositoryinterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * Controller show page question
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $user = Auth::user();
        // 0: man 1: woman
        if ($user->gender == 0) {
            $user->txt_gender = 'Nam';
        } else {
            $user->txt_gender = 'Nữ';
        }
        $eWallet = $this->userRepository->getWallet($user);
        $eWallet = $this->userRepository->joinCourse($eWallet);

        return view('frontend.pages.user.detail', compact('user', 'eWallet'));
    }

    /**
     * Controller function show infomation in form edit customer
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = $this->userRepository->find(Auth::user()->id);
        if ($user->gender == 0) {
            $user->txt_gender = 'Nam';
        } else {
            $user->txt_gender = 'Nữ';
        }

        return view('frontend.pages.user.edit', compact('user'));
    }

    /**
     * Controller function update information of user logged
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(Request $request)
    {
        Validation::validateUser($request);
        if (!Auth::check()) {
            return redirect('/');
        }

        $param = $request->all();
        if ($request->hasFile('avatar')) {
            // Update avatar here
            $ava = app()->make(UploadFileHelper::class)->uploadAvatar($request);
            if ($ava === 0) {
                return redirect()->back()->with('status', 'File tải lên bị lỗi định dạng');
            }
            if ($ava === 1) {
                return redirect()->back()->with('status', 'File tải lên vượt quá dung lượng quy định 2mb');
            }
            if ($ava === 2) {
                return redirect()->back()->with('status', 'Lỗi hệ thống, hãy thử lại sau');
            }
            $param['avatar'] = $ava;
        }

        $update = $this->userRepository->update($param, Auth::user()->id);
        if ($update) {
            return redirect('/hoc-vien/cap-nhat')->with('status', 'Cập nhật dữ liệu thành công.');
        }

        return redirect('/hoc-vien/cap-nhat')->with('status', 'Cập nhật dữ liệu thất bại, hãy kiểm tra lại thông tin.');
    }

    /**
     * Call to factory and pass param $request
     *
     * @param Request $request
     * @return
     */
    public function credit(Request $request)
    {
        $payGate = new PayGateFactory();
        $param = $request->all();
        switch ($param['paygate']) {
            case 'momo':
                return $payGate->momoInitPayment($request);
                break;
            case 'vnpay':
                return $payGate->vnPayInitPayment($request);
                break;
            case 'nganluong':
                return '<meta http-equiv="refresh" content="0; url='.$payGate->nganLuongInitPayment($request).'" >';
                break;
        }
    }

    /**
     * Call back function payment transaction
     *
     * Update amount and insert to table e_wallet_detail and logs
     * Paygate VNPay
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function vnPayCallBack(Request $request)
    {
        if ($request->vnp_ResponseCode !== "00") {
            return redirect('/hoc-vien/thong-tin')->with('status', 'Có lỗi khi tiến hành giao dịch');
        }
        $findWallet = app()->make(EWalletHelper::class)->findEWallet(Auth::user()->id);
        if (empty($findWallet)) {
            return redirect('/hoc-vien/thong-tin')->with('status', 'Không tìm thấy ví điện tử');
        }
        $param['e_wallet_id'] = $findWallet->id;
        $param['price'] = $request->vnp_Amount / 100;
        $param['status'] = 1;  // 0: mua khoa hoc 1: nap them tien
        $createDetail = app()->make(EWalletHelper::class)->createTransaction($param);
        if ($createDetail) {
            app()->make(EWalletHelper::class)->updateAmount($param, $findWallet);
            $param['note'] = $request->vnp_OrderInfo;
            $param['paygate'] = 'vn-pay';
            $param['code_charge'] = '';
            $param['e_wallet_detail_id'] = $createDetail->id;
            app()->make(EWalletHelper::class)->transactionStoreLog($param);
            Log::info('Tài khoản . ' . Auth::user()->email . ' nạp credit với VNPay số tiền: ' . $request->vnp_Amount . '\n');
            return redirect('/hoc-vien/thong-tin')->with('status', 'Nạp tiền thành công!');
        }

        return redirect('/hoc-vien/thong-tin')->with('status', 'Có lỗi hệ thống sảy ra, hãy kiểm tra lại!');
    }

    /**
     *  Call back function payment transaction
     *
     * Update amount and insert to table e_wallet_detail and logs
     * Paygate NganLuong
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function nganLuongCallBack(Request $request)
    {
        if ($request->error_text !== null) {
            return redirect('/hoc-vien/thong-tin')->with('status', 'Nạp tiền thất bại, hãy kiểm tra lại');
        }
        $findWallet = app()->make(EWalletHelper::class)->findEWallet(Auth::user()->id);
        if (empty($findWallet)) {
            return redirect('/hoc-vien/thong-tin')->with('status', 'Không tìm thấy ví điện tử');
        }
        $param['e_wallet_id'] = $findWallet->id;
        $param['price'] = $request->price / 100;
        $param['status'] = 1;  // 0: mua khoa hoc 1: nap them tien
        $createDetail = app()->make(EWalletHelper::class)->createTransaction($param);
        if ($createDetail) {
            app()->make(EWalletHelper::class)->updateAmount($param, $findWallet);
            $param['note'] = $request->transaction_info;
            $param['paygate'] = 'ngan-luong';
            $param['code_charge'] = '';
            $param['e_wallet_detail_id'] = $createDetail->id;
            app()->make(EWalletHelper::class)->transactionStoreLog($param);
            Log::info('Tài khoản . ' . Auth::user()->email . ' nạp credit với ngân lượng số tiền: ' . $request->price . ' secure_code: ' .  $request->secure_code . ' token_nl' . $request->token_nl . '\n');
            return redirect('/hoc-vien/thong-tin')->with('status', 'Nạp tiền thành công!');
        }

        return redirect('/hoc-vien/thong-tin')->with('status', 'Có lỗi hệ thống sảy ra, hãy kiểm tra lại!');
    }

    /**
     *  Call back function payment transaction
     *
     * Update amount and insert to table e_wallet_detail and logs
     * Paygate PayPal
     * @param Request $request
     * @return
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function payPalCallBack(Request $request)
    {
        $param = $request->all();
        $findWallet = app()->make(EWalletHelper::class)->findEWallet(Auth::user()->id);
        if (empty($findWallet)) {
            return app()->make(ResponseHelper::class)->notFound();
        }
        $param['e_wallet_id'] = $findWallet->id;
        $param['price'] = $request->amount;
        $param['status'] = 1;  // 0: mua khoa hoc 1: nap them tien
        // create e-wallet-detail
        $createDetail = app()->make(EWalletHelper::class)->createTransaction($param);
        if ($createDetail) {
            app()->make(EWalletHelper::class)->updateAmount($param, $findWallet);
            $param['note'] = 'Nạp tiền vào tài khoản';
            $param['paygate'] = 'paypal';
            $param['code_charge'] = '';
            $param['e_wallet_detail_id'] = $createDetail->id;
            app()->make(EWalletHelper::class)->transactionStoreLog($param);
            Log::info('Tài khoản . ' . Auth::user()->email . ' nạp credit với PayPAl số tiền: ' . $request->amount . '\n');
            return app()->make(ResponseHelper::class)->success();
        }

        return app()->make(ResponseHelper::class)->error();
    }
}
