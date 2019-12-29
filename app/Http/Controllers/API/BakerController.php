<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bakers;
class BakerController extends Controller
{
	public $successStatus = 200;

    public function addbaker(Request $request)
    {

    	$bakers = New Bakers;
    	$bakers->smart_id = $request->smart_id;
    	$bakers->first_name = $request->first_name;
    	$bakers->last_name = $request->last_name;
    	$bakers->address = $request->address;
    	$bakers->phone = $request->phone;
    	$bakers->mobile = $request->mobile;
    	$bakers->birthday = $request->birthday;
    	$bakers->national_code = $request->national_code;
    	$bakers->birth_number = $request->birth_number;
    	$bakers->postal_code = $request->postal_code;
    	$bakers->bakingtype_id = $request->bakingtype_id;
    	$bakers->city_id = $request->city_id;
    	$bakers->zone_id = $request->zone_id;
    	$bakers->lat = $request->lat;
    	$bakers->lng = $request->lng;
    	$bakers->quata_number = $request->quata_number;
    	$bakers->desc = $request->desc;
    	$bakers->violation = $request->violation;
    	$bakers->reason_violation = $request->reason_violation;
    	$bakers->free_cook = $request->free_cook;
    	$bakers->status = $request->status;
    	$bakers->sick = $request->sick;
    	$bakers->save();
    	return response()->json(['data' => null , 'massage' => 'نانوا با موفقیت اضافه شد.' , 'status' => 200], $this->successStatus);

    	# code...
    }

     public function getbakers(Request $request)
    {
        $pageindex = $request->pageindex;
        $limit = $request->limit;
        $bakercount = Bakers::count();
        $bakerlist = Bakers::with('city')->with('bakingtype')->with('zone')->skip(($pageindex-1)*$limit)->take($limit)->get();
        return response()->json(['data' => ['bakerlist'=>$bakerlist ,'bakercount'=>$bakercount], 'massage' => 'لیست کل نانوایان.' , 'status' => 200], $this->successStatus);

    }

     public function getbaker(Request $request)
    {
        $baker = Bakers::with('city')->with('bakingtype')->with('zone')->find($request->id);
        return response()->json(['data' => $baker , 'massage' => 'اطلاعات نانوا.' , 'status' => 200], $this->successStatus);

    }

    public function updatebaker(Request $request)
    {
    	$bakers = Bakers::find($request->id);
    	$bakers->smart_id = $request->smart_id;
    	$bakers->first_name = $request->first_name;
    	$bakers->last_name = $request->last_name;
    	$bakers->address = $request->address;
    	$bakers->phone = $request->phone;
    	$bakers->mobile = $request->mobile;
    	$bakers->birthday = $request->birthday;
    	$bakers->national_code = $request->national_code;
    	$bakers->birth_number = $request->birth_number;
    	$bakers->postal_code = $request->postal_code;
    	$bakers->bakingtype_id = $request->bakingtype_id;
    	$bakers->city_id = $request->city_id;
    	$bakers->zone_id = $request->zone_id;
    	$bakers->lat = $request->lat;
    	$bakers->lng = $request->lng;
    	$bakers->quata_number = $request->quata_number;
    	$bakers->desc = $request->desc;
    	$bakers->violation = $request->violation;
    	$bakers->reason_violation = $request->reason_violation;
    	$bakers->free_cook = $request->free_cook;
    	$bakers->status = $request->status;
    	$bakers->sick = $request->sick;
    	$bakers->save();
    	return response()->json(['data' => null , 'massage' => 'تغییرات با موفقیت اعمال شد.' , 'status' => 200], $this->successStatus);

    	# code...
    }
}
