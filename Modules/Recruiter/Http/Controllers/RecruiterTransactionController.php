<?php

namespace Modules\Recruiter\Http\Controllers;

use App\Repository\AccountPackage\IAccountPackageRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RecruiterTransactionController extends Controller
{
    private $vnp_TmnCode = "UMFWBMCM"; //Mã website tại VNPAY  shopgiay.com
    private $vnp_HashSecret = "WQGBIWIEWGBPKDFGYWVAXFSBKFLMMRYB"; //Chuỗi bí mật
    private $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    private $vnp_Returnurl = "http://phuongnamrecruiment.com:8000/recruiters/transaction/pay/order";
    public $transactionRepository;
    public $accountPackageRepository;
    public function __construct(ITransactionRepository $transactionRepository,IAccountPackageRepository $accountPackageRepository)
    {
         $this->transactionRepository = $transactionRepository;
         $this->accountPackageRepository = $accountPackageRepository;
    }

    public function getBill(Request $request){
        if($request->ajax()) {
            $html = view('recruiter::payment.bill')->render();
            return \response()->json($html);
        }
    }

    public function getTransactions(){

        $recruiterId = Auth::guard('recruiters')->user()->id;
        $transactions  = $this->transactionRepository->getTransactionRecruiterByPage($recruiterId,10);
        $transactionNew = $this->transactionRepository->getTransactionNew($recruiterId);
        $viewData = [
            'transactions' => $transactions,
            'transactionNew' => $transactionNew
        ];
        return view('recruiter::transaction.transaction-history',$viewData);
    }

    public function getRegisterAccountPackage(){
        $acPackages = $this->accountPackageRepository->getListAccountPackages();
        $viewData = [
            'acPackages' => $acPackages
        ];
        return view('recruiter::transaction.register-account-package',$viewData);
    }

    public function getPay(Request $request,$accountId){
        $accountPackage = $this->accountPackageRepository->getAccountPackageById($accountId);
        if($request->vnp_ResponseCode=='00'){
            $transactionId=$request->vnp_TxnRef;
            $transaction=$this->transactionRepository->getTransactionById($transactionId);
            if ($transaction) {
                $request->session()->forget('info_customer');
                return redirect()->intended('complete')->with(['flash-message'=>'Success ! Xác nhận giao dịch thành công !','flash-level'=>'success']);
            }
            return redirect()->to('/')->with(['flash-message'=>'Warning ! Mã giao dịch không tồn tại !','flash-level'=>'danger']);
        }else{
            $tranId=$request->vnp_TxnRef;
            $transaction=$this->transactionRepository->getTransactionById($tranId);
            if ($transaction) {
                $this->transactionRepository->deleteTransactionById($tranId);
                return redirect()->to('/')->with(['flash-message'=>'Error ! Có lỗi xảy ra, giao dịch không thành công. Mời bạn thao tác lại sau !','flash-level'=>'danger']);
            }
        }

        $viewData = [
            'accountPackage' => $accountPackage,
        ];
        return view('recruiter::transaction.pay-order',$viewData);
    }

    public function postPay(Request $request,$accountId){
        $data['info']=$request->all();
        $total=$request->amount;
        if (Auth::guard('recruiters')->check()) {
            $recruiter_id = Auth::guard('recruiters')->user()->id;
        }else{
            $recruiter_id = 1;
        }
        $transactionId = $this->transactionRepository->addTransaction($request, $recruiter_id,$accountId);

        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

        $vnp_OrderInfo = $request->note;
        $vnp_OrderType = $request->order_type;
        $vnp_Locale = $request->language;
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];


        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $total * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $this->vnp_Returnurl,
            "vnp_TxnRef" => $transactionId,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $this->vnp_Url. "?" . $query;
        if (isset($this->vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $this->vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        //echo json_encode($returnData);
        return redirect()->to($returnData['data']);
    }

    public function complete(){
        return view('recruiter::transaction.complete');
    }
}
