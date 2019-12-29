<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DirectionPrice;
use App\City;
use Auth;

class DirectionController extends Controller
{
	public $successStatus = 200;

   public function getalldirectionlist(Request $request)
   {
   	$city_list= City::where('type',1)->get();
   	$direction_list= DirectionPrice::with('city_from')->with('user')->with('city_to')->get();
   	return response()->json(['data' => ['direction_list'=>$direction_list,'city_list'=>$city_list] , 'massage' => 'دریافت اطلاعات مسیرها.' , 'status' => 200], $this->successStatus);
   }

   public function adddirectionprice(Request $request)
   {
   	$city_from = $request->cityIdFrom;
   	$city_to = $request->cityIdTo;
   	$direction_price = $request->directionPrice;
   	$new_direction = new DirectionPrice;
   	$new_direction->city_id_from = $city_from;
   	$new_direction->city_id_to = $city_to;
   	$new_direction->price = $direction_price;
   	$new_direction->user_id = Auth::id();
   	$new_direction->save();
   	return response()->json(['data' => [null] , 'massage' => 'مسیر با موفقیت اضافه شد.' , 'status' => 200], $this->successStatus);
   }
}
