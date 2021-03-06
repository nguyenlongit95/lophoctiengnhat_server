<?php

namespace App\Factory\Paygates;

use App\Factory\Paygates\MoMo\MoMo;
use App\Factory\Paygates\NganLuong\NLCheckout;
use App\Factory\Paygates\Paypal\PayPal;
use App\Factory\Paygates\VNPAY\VNPAY;
use App\Models\Paygate;
use App\Support\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayGateFactory
{
    /**
     * Define code of pay gate here
     */
    const CODE_PAYPAL = 'paypal';
    const CODE_NGANLUONG = 'nganluong';
    const CODE_VN_PAY = 'vnpay';
    const CODE_MOMO = 'momo';

    /**
     * Function controller init param and get data payment
     *
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function payPalInitPayment(Request $request)
    {
        $paypal = new PayPal();
        $getConfig = $paypal->getData();
        if (!empty($getConfig)) {
            $config = json_decode($getConfig->configs, true);
            $getConfig->API_USERNAME = $config['API_USERNAME'];
            $getConfig->API_PASSWORD = $config['API_PASSWORD'];
            $getConfig->API_SIGNATURE = $config['API_SIGNATURE'];
            $getConfig->SECRET_ID = $config['SECRET_ID'];
            $getConfig->CLIENT_ID = $config['CLIENT_ID'];
            $getConfig->SANBOX_ACCOUNT = $config['SANBOX_ACCOUNT'];
            $getConfig->SECRET_ID = $config['VERSION'];
        }

        return app()->make(ResponseHelper::class)->success($getConfig);
    }

    /**
     * Controller init payment has using data from client and get data config in server
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongInitPayment(Request $request)
    {
        $paygate = Paygate::where('code', self::CODE_NGANLUONG)->first();
        if (empty($paygate)) {
            return redirect('/');
        }
        $param = $request->all();
        if ($param['price'] < 2000) {
            return redirect('/');
        }
        /**
         * The information has get in database
         * code = nganluong
         */
        $NGANLUONG_URL = $paygate->url;                                     // URL checkout
        $config = json_decode($paygate->configs, true);
        $RECEIVER = $config['RECEIVER'];                                    // Email t??i kho???n Ng??n L?????ng
        $MERCHANT_ID = $config['MERCHANT_ID'];                              // M?? k???t n???i
        $MERCHANT_PASS = $config['MERCHANT_PASS'];                          // M???t kh???u k???t n???i

        // URL s??? tr??? v??? khi thanh to??n
        $receiver = $RECEIVER;
        $order_code = 'NL_' . time();                                       // M?? ????n h??ng s??? nh???n t??? b???ng cart
        $return_url = url('/pay-gate-callback/ngan-luong-success');
        $cancel_url= url('/pay-gate-callback/cancel');
        $notify_url = url('/pay-gate-callback/success');

        // Th??ng tin v?? gi?? c??? c???a gi??? h??ng l???n ng?????i d??ng
        $txh_name = Auth::user()->name;
        $txt_email = Auth::user()->email;
        $txt_phone = Auth::user()->phone;
        $price = (int) $param['price'];

        // Kh???i t???o th??ng tin giao d???ch
        $transaction_info = "Thong tin giao dich";
        $currency = $config['currency'];
        $quantity = 1;                                                      // S??? ????n thanh to??n m???c ?????nh l?? 1
        $tax = 0;                                                           // Thu??? m???c ?????nh l?? 0 n???u c?? th?? th?????ng l?? 10%
        $discount = 0;                                                      // M?? gi???m gi?? m???c ?????nh l?? 0
        $fee_cal = 0;                                                       // M?? mi???n thu??? m???c ?????nh l?? 0
        $fee_shipping = 0;                                                  // M?? free ship m???c ?????nh l?? 0
        $order_description = "Thong tin don hang: " . $order_code;
        $buyer_info = $txh_name . "*|*" . $txt_email . "*|*" . $txt_phone;
        $affiliate_code = "";                                               // M?? ?????i t??c m???c ?????nh ""

        // Khai b??o ?????i t?????ng c???a l???p NL_Checkout
        $nl = new NLCheckout();
        $nl->nganluong_url = $NGANLUONG_URL;
        $nl->merchant_site_code = $MERCHANT_ID;
        $nl->secure_pass = $MERCHANT_PASS;

        // T???o link thanh to??n ?????n nganluong.vn
        return $nl->buildCheckoutUrlExpand(
            $return_url, $receiver, $transaction_info, $order_code, $price, $currency, $quantity, $tax, $discount ,
            $fee_cal, $fee_shipping, $order_description, $buyer_info , $affiliate_code
        );
    }

    /**
     * Controller success payment from nganluong.vn and update order, redirect page here
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongSuccessPayment(Request $request)
    {
        $paygate = Paygate::where('code', self::CODE_NGANLUONG)->first();
        /**
         * The information has get in database
         * code = nganluong
         */
        $param = $request->all();
        $config = json_decode($paygate->configs, true);

        $transaction_info = $param['transaction_info'];
        $order_code = $param['order_code'];
        $price = $param['price'];
        $payment_id = $param['payment_id'];
        $payment_type = $param['payment_type'];
        $error_text = $param['error_text'];
        $secure_code = $param['secure_code'];
        //Khai b??o ?????i t?????ng c???a l???p NL_Checkout
        $nl = new NLCheckout();
        $nl->merchant_site_code = $config['MERCHANT_ID'];
        $nl->secure_pass = $config['MERCHANT_PASS'];
        //T???o link thanh to??n ?????n nganluong.vn
        $checkpay= $nl->verifyPaymentUrl($transaction_info, $order_code, $price, $payment_id, $payment_type, $error_text, $secure_code);
        if ($checkpay) {
            // TODO Thanh to??n th??nh c??ng c???p nh???t th??ng tin ????n h??ng t???i ????y
            return true;
        } else {
            return false;
        }
    }

    /**
     * Controller cancel payment from user and redirect pages here
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongCancelPayment(Request $request)
    {
        return false;
    }

    /**
     * Controller payment failed and redirect pages here
     *
     * @param Request $request
     * @return bool
     */
    public function nganLuongFailedPayment(Request $request)
    {
        return false;
    }

    /**
     * Controller init payment of vn_pay
     *
     * @param Request $request
     * @return bool
     */
    public function vnPayInitPayment(Request $request)
    {
        $payGate = Paygate::where('code', self::CODE_VN_PAY)->first();
        if (empty($payGate)) {
            return redirect('/');
        }
        $param = $request->all();
        $configs = json_decode($payGate->configs, true);
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url('/pay-gate-callback/vn-pay');
        $vnp_TmnCode = $configs['vnp_TmnCode'];                                // M?? website t???i VNPAY
        $vnp_HashSecret = $configs['vnp_HashSecret'];                          // Chu???i b?? m???t

        $vnp_TxnRef = date('YmdHis');                                   //M?? ????n h??ng l???y t??? b???ng cart trong DB
        $vnp_OrderInfo = "Thanh to??n h??a ????n ph?? dich v???";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $param['price'] * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();
        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        $vnPay = new VNPAY();
        $renderUrl = $vnPay->doDirectPayment($inputData, $vnp_Url, $vnp_HashSecret);

        return '<meta http-equiv="refresh" content="0; url='.$renderUrl.'" >';
    }

    /**
     * Function process data vnpay return
     *
     * @param Request $request
     */
    public function vnPayReturn(Request $request)
    {
        dd($request->all());
    }

    /**
     * Controller payment using momo e-wallet
     *
     * @param Request $request
     * @return mixed
     */
    public function momoInitPayment(Request $request)
    {
        header('Content-type: text/html; charset=utf-8');

        $paygate = Paygate::where('code', self::CODE_MOMO)->first();
        $config = $paygate->configs;
        $array = json_decode($config, true);
        $param = $request->all();
        $momo = new MoMo();

        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        /**
         * Create param
         */
        $partnerCode = $array["partnerCode"];
        $accessKey = $array["accessKey"];
        $serectkey = $array["secretKey"];
        $orderId = time() . "";                              // M?? ????n h??ng trong b???ng cart
        $orderInfo = "Th??ng tin c???a ????n h??ng";
        $amount = $param["amount"];
        $notifyurl = url('/momo/ipn');                 // L??u ??: link notifyUrl kh??ng ph???i l?? d???ng localhost
        $returnUrl = url('/momo/result');

        $requestId = time() . "";
        $requestType = "captureMoMoWallet";
        $extraData = (isset($param["extraData"]) ? $param["extraData"] :  "merchantName=MoMo Partner");
        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data = array(
            "accessKey" => $accessKey,
            "partnerCode" => $partnerCode,
            "requestType" => "captureMoMoWallet",
            "notifyUrl" => $notifyurl,
            "returnUrl" => $returnUrl,
            "orderId" => $orderId,
            "amount" => $param['price'],
            "orderInfo" => "Order info",
            "requestId" => $requestId,
            "extraData" => $extraData,
            "signature" => $signature,
        );
        $result = $momo->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);   // decode json

        //Just a example, please check more in there
        return $jsonResult;
    }

    /**
     * Controller init payment using momo e-wallet
     *
     * @param Request $request
     */
    public function momoResult(Request $request)
    {
        dd($request->all());
    }
}
