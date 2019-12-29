<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Drivers;
use App\Service;
use App\Orders;
use Excel;
use App\Exports\DriversReportExport;

class ReportDriversController extends Controller
{
    public $successStatus = 200;
    public function getdriverlistreport(Request $request)
    {
        $pageindex = $request->pageindex;
    	$limit = $request->limit;
    	$drivers = Drivers::with('navy')->with('services')->get();
    	$driverscount=Drivers::count();
        return response()->json(['data' => ['driverslist'=>$drivers,'driverscount'=>$driverscount] , 'massage' => 'لیست کل سرویس ها برای گزارش گیری.' , 'status' => 200], $this->successStatus);
    }

    public function getdetailservicereport(Request $request)
    {
    	$orders = Orders::where('service_id',$request->service_id)->with('deposit')->with('baker')->with('navy')->with('flourfactory')->get();
    	return response()->json(['data' => ['servicedetail'=>$orders] , 'massage' => 'اطلاعات سرویس.' , 'status' => 200], $this->successStatus);
    }
    public function exportreportdriver(Request $request)
    {
        $ordersList=[];
        $serviceList = Service::with('orders')->with('driver')->with('flourfactory')->where('driver_id',$request->driver_id)->whereBetween('transport_date', [$request->fromdate, $request->todate])->orderBy('id','desc')->get();
         foreach ($serviceList as $service) {
             $orders=Orders::with('service')->with('driver')->with('flourfactory')->with('baker')->with('deposit')->with('navy')->where('service_id',$service->id)->get();
             if (!$orders->isEmpty()) {
                 # code...
                array_push($ordersList, $orders);

             }
         }
        return response()->json(['data' => ['serviceList'=>$ordersList] , 'massage' => 'اطلاعات گزارش رانندگان' , 'status' => 200], $this->successStatus);
    }
}
