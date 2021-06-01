<?php

namespace App\Http\Controllers\FrontEnd;

use App\Factory\Paygates\MoMo\MoMo;
use App\Factory\Paygates\Paypal\PayPal;
use App\Factory\Paygates\VNPAY\VNPAY;
use App\Http\Controllers\Controller;
use App\Models\Paygate;
use App\Repositories\DocResources\DocResourcesRepositoryInterface;
use App\Support\EWalletHelper;
use App\Support\ResponseHelper;
use Illuminate\Http\Request;
use App\Factory\Paygates\NganLuong\NLCheckout;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;

class PaymentController extends Controller
{
    /**
     * @var DocResourcesRepositoryInterface
     */
    private $docResourceRepository;

    /**
     * PaymentController constructor.
     * @param DocResourcesRepositoryInterface $docResourceRepository
     */
    public function __construct(DocResourcesRepositoryInterface $docResourceRepository)
    {
        $this->docResourceRepository = $docResourceRepository;
    }

    public function checkPurchase(Request $request)
    {
        $eWallet = app(EWalletHelper::class)->findEWallet(Auth::user()->id);
        if (empty($eWallet)) {
            return redirect('/');
        }
        $param = $request->all();
        // check purchase using type and case
        switch ($param['type_doc']) {
            case 'doc_resource':
                $docResource = $this->docResourceRepository->find($param['idDoc']);
                $docResource->price = number_format($docResource->price, 0) . ' (vnd)';
                $checkPurchase = $this->docResourceRepository->checkPurchase($docResource, $eWallet->e_wallet_detail);
                $responseData = [];
                if (empty($checkPurchase)) {
                   // Chua mua khoa hoc da chon
                    $responseData['link_download'] = '';
                    $responseData['purchase_status'] = 'not_purchase';
                    $responseData['resource'] = $docResource;
                } else {
                    // Da mua khoa hoc
                    $responseData['link_download'] = asset('/source/documentation/' . $docResource->url_source);
                    $responseData['purchase_status'] = 'purchased';
                    $responseData['resource'] = $docResource;
                }
                return app()->make(ResponseHelper::class)->success($responseData);
            // TODO continue as more course
            default:
                return redirect('/');
                break;
        }
    }

    public function purchase(Request $request)
    {
        $eWallet = app()->make(EWalletHelper::class)->findEWallet(Auth::user()->id);
        $param = $request->all();
        switch ($param['type_doc']) {
            case 'doc_resource':
                // purchase doc_resource
                $docResource = $this->docResourceRepository->find($param['id']);
                if ($eWallet->amount >= $docResource->price) {
                    // add to table EWalletDetail
                    $purchase = app()->make(EWalletHelper::class)->createTransaction($this->_initDataPurchase($eWallet->id, $docResource->price, 0, $docResource->code));
                    if (empty($purchase)) {
                        return redirect('/hoc-vien/thong-tin')->with('status', 'Có lỗi hệ thống, hãy kiểm tra lại!');
                    }
                    // insert log transactions
                    app()->make(EWalletHelper::class)->transactionStoreLog($this->_initDataEWalletLog($purchase->id, 'Mua tài liệu: ' .$docResource->name, '', $docResource->code));
                    // update amount
                    $param['price'] = $docResource->price;
                    $updateAmount = app()->make(EWalletHelper::class)->subPenAmount($param, $eWallet);
                    if (!$updateAmount) {
                        return redirect('/hoc-vien/thong-tin')->with('status', 'Bạn không đủ tiền trong ví, hãy nạp thêm tiền!');
                    }

                    return  '<meta http-equiv="refresh" content="0; url='.asset('/source/documentation/' . $docResource->url_source).'" >';
                } else {
                    return redirect('/hoc-vien/thong-tin')->with('status', 'Bạn không đủ tiền trong ví, hãy nạp thêm tiền!');
                }
            // TODO continue as more course purchase
            default:
                return redirect('/');
                break;
        }
    }

    private function _initDataPurchase($eWalletId, $price, $status, $codeCharge)
    {
        // EWalletDetail
        $param['e_wallet_id'] = $eWalletId;
        $param['price'] = $price;
        $param['status'] = $status;
        $param['code_charge'] = $codeCharge;

        return $param;
    }

    private function _initDataEWalletLog($eWalletDetailId, $note, $payGate, $codeCharge)
    {
        $param['e_wallet_detail_id'] = $eWalletDetailId;
        $param['note'] = $note;
        $param['paygate'] = $payGate;
        $param['code_charge'] = $codeCharge;

        return $param;
    }
}
