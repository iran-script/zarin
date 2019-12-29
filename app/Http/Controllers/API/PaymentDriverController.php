<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankAccountCompany;
use App\PaymentDriver;
use App\TotalPriceDriver;
use Auth;

class PaymentDriverController extends Controller
{
	public $successStatus = 200;
	
    public function searchfindaccountcompany(Request $request)
    {

    	$bankaccountcompany = BankAccountCompany::where('smart_number', 'LIKE', '%' . $request->smart_number . '%')->orWhere('sheba_number', 'LIKE', '%' . $request->smart_number . '%')->orWhere('title', 'LIKE', '%' . $request->smart_number . '%')->get();
        return response()->json(['data' => ['bankaccountcompany'=>$bankaccountcompany] , 'massage' => 'دریافت اطلاعات راننده.' , 'status' => 200], $this->successStatus);
    }

    public function addpaymentdriver(Request $request)
    {
    	$PaymentDriver =new PaymentDriver;
    	$PaymentDriver->type_payment_id =$request->type_payment_id;
    	$PaymentDriver->price =$request->price;
    	$PaymentDriver->payment_smart_number =$request->payment_smart_number;
    	$PaymentDriver->bank_account_company_id =$request->bank_account_company_id;
    	$PaymentDriver->driver_id =$request->driver_id;
    	$PaymentDriver->user_id =Auth::id();
    	$PaymentDriver->payment_date =$request->payment_date;
    	$PaymentDriver->verify =0;
    	$PaymentDriver->save();
    	return response()->json(['data' => [null] , 'massage' => 'ثبت شد. برای اعمال این پرداخت در صورت وضعیت راننده باید آن را تایید نمایید' , 'status' => 200], $this->successStatus);
    }

    public function getaccountingpricedrivers(Request $request)
    {
    	$pageindex = $request->pageindex;
    	$limit = $request->limit;
    	$paymentdriverlist = PaymentDriver::with('type_payment')->with('bank')->with('driver')->with('user')->with('bankaccountcompany')->with('totalpricedriver')->orderBy('id','desc')->skip(($pageindex-1)*$limit)->take($limit)->get();
    	$paymentdrivercount = PaymentDriver::count();
    	return response()->json(['data' => ['paymentdriverlist'=>$paymentdriverlist,'paymentdrivercount'=>$paymentdrivercount] , 'massage' => 'دریافت لیست پرداختی های رانندگان.' , 'status' => 200], $this->successStatus);
    }
    public function verifyaccountingpaymentdriver(Request $request)
    {
        $paymentdriver = PaymentDriver::find($request->id);
        $totalpricedriver = TotalPriceDriver::where('driver_id',$paymentdriver->driver_id)->first();
        if ($paymentdriver->price < $totalpricedriver->totalprice) {
        $paymentdriver->verify = 1;
        $paymentdriver->save();
        $totalpricedriver = TotalPriceDriver::where('driver_id',$paymentdriver->driver_id)->first();
        $totalpricedriver->totalprice = $totalpricedriver->totalprice  -= $paymentdriver->price;
        $totalpricedriver->save();
        return response()->json(['data' => [null] , 'massage' => 'پرداخت تایید شد.' , 'status' => 200], $this->successStatus);
        }
        else{
        return response()->json(['data' => [null] , 'massage' => 'قیمت خارج از محدوه میباشد.' , 'status' => 500], $this->successStatus);

        }
        
    }

}
