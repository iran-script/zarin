<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\Orders;
use App\DirectionPrice;
use Auth;
class ServiceController extends Controller
{
	public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function addservice(Request $request)
    {
    	$service = new Service;
    	$service->province_id = $request->province_id;
    	$service->city_id = $request->city_id;
    	$service->flourfactory_id = $request->flourfactory_id;
    	$service->driver_id = $request->driver_id;
    	$service->navy_id = $request->navy_id;
        $service->area_id = $request->area_id;
        $service->transport_date = $request->transport_date;
        $service->price_verify = 0;
        $service->price = 0;
        $service->user_id = Auth::id();
    	$service->save();
    	return response()->json(['data' => ['service_id'=>$service->id] , 'massage' => 'سرویس با موفیقت اضافه شد.' , 'status' => 200], $this->successStatus);
    }

    public function getservices(Request $request)
    {
    	$pageindex = $request->pageindex;
    	$limit = $request->limit;
    	$servicelist = Service::with('user')->with('province')->with('orders')->with('city')->with('area')->with('flourfactory')->with('navy')->with('driver')->skip(($pageindex-1)*$limit)->take($limit)->get();
    	$servicecount=Service::count();
    	return response()->json(['data' => ['servicelist'=>$servicelist,'servicecount'=>$servicecount] , 'massage' => 'دریافت لیست سرویس ها.' , 'status' => 200], $this->successStatus);
    
    }

    public function getservice(Request $request)
    {
    	$service = Service::where('id',$request->id)->with('user')->with('province')->with('city')->with('area')->with('flourfactory')->with('navy')->with('driver')->first();
        $direction_price = DirectionPrice::where('city_id_from',$service->flourfactory->city_id)->where('city_id_to',$service->city_id)->orderBy('id','desc')->first();
    	$orders = Orders::with('deposit')->with('baker')->with('navy')->with('driver')->with('flourfactory')->where('service_id',$service->id)->get();
    	return response()->json(['data' => ['service'=>$service,'orders'=>$orders ,'direction_price'=>$direction_price] , 'massage' => 'دریافت لیست سرویس ها.' , 'status' => 200], $this->successStatus);
    }
    public function updatetotalpriceservice(Request $request)
    {
        Service::find($request->service_id)->update(['price' => $request->totalprice]); 
        return response()->json(['data' => [null] , 'massage' => 'قیمت سرویس اپدیت شد.' , 'status' => 200], $this->successStatus);
        # code...
    }
}
