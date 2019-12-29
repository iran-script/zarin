<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bakers;
use App\Orders;

class ReportBakersController extends Controller
{
	public $successStatus = 200;
	private $fromdate =Null;
	private $todate =Null;

	public function exportreportbaker(Request $request)
	{
		$this->fromdate=$request->fromdate;
		$this->todate=$request->todate;
		$orderList = Orders::with('service')->whereHas('service', function ($q) {
          $q->whereBetween('transport_date', [$this->fromdate, $this->todate]);
        })->with('deposit')->with('baker')->with('driver')->where('baker_id',$request->baker_id)->orderBy('id','desc')->get();
		return response()->json(['data' => ['orderList'=>$orderList] , 'massage' => 'دریافت گزارشات نانوایان.' , 'status' => 200], $this->successStatus);
	}
}
