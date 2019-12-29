<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;
use App\Deposit;
use App\Service;
use App\DirectionPrice;
use App\TotalPriceDriver;

class OrdersController extends Controller
{
	public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function getallorders(Request $request)
    {
    	$pageindex = $request->pageindex;
    	$limit = $request->limit;
        $orderscount= Orders::count();
    	$orderslist = Orders::with('deposit')->with('baker')->with('service')->with('navy')->with('driver')->with('flourfactory')->skip(($pageindex-1)*$limit)->take($limit)->get();
    	return response()->json(['data' => ['orderslist'=>$orderslist,'orderscount'=>$orderscount] , 'massage' => 'حواله ها.' , 'status' => 200], $this->successStatus);
    }

    public function addordertoservice(Request $request)
    {

        $orders= New Orders;
        $orders->depo_id = $request->depo_id;
        $orders->baker_id = $request->baker_id;
        $orders->service_id = $request->service_id;
        $orders->navy_id = $request->navy_id;
        $orders->driver_id = $request->driver_id;
        $orders->factory_id = $request->factory_id;   
        $orders->verify_order = 0;   
        $orders->print = 0;   
        $orders->save(); 
        $deposit = Deposit::find($request->depo_id);
        $deposit->status = 1;
        $deposit->save(); 
        $service =Service::find($request->service_id);
        $service->price = $service->price + $request->price;
        $service->save();

        return response()->json(['data' => [$request->depo_id] , 'massage' => 'حواله ها.' , 'status' => 200], $this->successStatus);
    }
    public function removeorderfromservice(Request $request)
    {
        $depo_id = $request->depo_id;
        $order=Orders::where('depo_id',$depo_id)->delete();
        $deposit = Deposit::find($request->depo_id);
        $deposit->status = 0;
        $deposit->save(); 
        $service = Service::find($request->service_id);
        $service->price = $service->price - ($deposit->number_bags * $request->direction_price);
        $service->save();

        return response()->json(['data' => [null] , 'massage' => 'لیست فیش های واریزی مربوط به سرویس.' , 'status' => 200], $this->successStatus);
    }
    public function verifyorder(Request $request)
    {
       $order_id =$request->order_id;
       $order=Orders::with('service')->with('flourfactory')->with('deposit')->with('driver')->find($order_id);
       $order->verify_order=1;
       $order->save();


       $direction_price = DirectionPrice::where('city_id_from',$order->flourfactory->city_id)->where('city_id_to',$order->service->city_id)->orderBy('id','desc')->first();

       $service = Service::find($order->service_id);
       $service->price_verify +=  $order->deposit->number_bags * $direction_price->price;
       $service->save();

       $totalpricedriver=TotalPriceDriver::where('driver_id',$order->driver_id)->first();

       $totalpricedriver->totalprice += $order->deposit->number_bags * $direction_price->price;
       $totalpricedriver->save();
       return response()->json(['data' => [$service] , 'massage' => 'حواله رسید شد.' , 'status' => 200], $this->successStatus);
    }
    public function getorder(Request $request)
    {
        $order =Orders::where('id',$request->id)->with('deposit')->with('baker')->with('service')->with('navy')->with('driver')->with('flourfactory')->first();
        Orders::where('id',$request->id)->update(['print' => 1]);

        return response()->json(['data' => ['order'=>$order] , 'massage' => 'پرینت حواله.' , 'status' => 200], $this->successStatus);
        # code...
    }
    public function printordersservice(Request $request)
    {
    $service_id = $request->id;
    $orders = Orders::where('service_id',$service_id)->update(['print' => 1]);

    return response()->json(['data' => ['service_id'=>$service_id] , 'massage' => 'پرینت کل حواله های سرویس.' , 'status' => 200], $this->successStatus);
    }
    
}
