<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Navy;
use App\Drivers;

class NavyController extends Controller
{
    public $successStatus = 200;

    public function addnavy(Request $request)
    {
    	$navy = new Navy;
        $navy->plates_number=$request->plates_number;
    	$navy->smart_id=$request->smart_id;
    	$navy->insurance_number=$request->insurance_number;
    	$navy->employmenttype_id=$request->employmenttype_id;
    	$navy->chassis_number = $request->chassis_number	;
    	$navy->year_making = $request->year_making;
    	$navy->spare_serial = $request->spare_serial;
    	$navy->expire_insurance = $request->expire_insurance;
    	$navy->expire_technical = $request->expire_technical;
    	$navy->driver_id = $request->driver_id;
    	$navy->age_car = $request->age_car;
    	$navy->plate_serial = $request->plate_serial;
    	$navy->camiontype_id = $request->camiontype_id;
    	$navy->motor_number = $request->motor_number;
    	$navy->veterinary_code = $request->veterinary_code;
    	$navy->status = $request->status;
    	$navy->capacity = $request->capacity;
    	$navy->save();
    	return response()->json(['data' => null , 'massage' => 'ماشین با موفقیت ثبت شد.' , 'status' => 200], $this->successStatus);

    }

    public function getnavylist(Request $request)
    {
        $pageindex = $request->pageindex;
        $limit = $request->limit;
        $navycount= Navy::count();
        $navylist = Navy::with('driver')->with('camiontype')->with('employmenttype')->skip(($pageindex-1)*$limit)->take($limit)->get();
        return response()->json(['data' => ['navylist'=>$navylist,'navycount'=>$navycount] , 'massage' => 'لیست کل ناوگان.' , 'status' => 200], $this->successStatus);

    }

    public function getnavy(Request $request)
    {
        # code...
        $driver = Drivers::select('id','first_name','last_name')->get();
        $navy = Navy::with('driver')->with('camiontype')->with('employmenttype')->find($request->id);
        return response()->json(['data' => ['navylist'=>$navy,'driverlist'=>$driver] , 'massage' => 'اطلاعات ناوگان.' , 'status' => 200], $this->successStatus);


    }

     public function updatenavy(Request $request)
    {
        $navy =Navy::find($request->id);
        $navy->plates_number=$request->plates_number;
        $navy->smart_id=$request->smart_id;
        $navy->insurance_number=$request->insurance_number;
        $navy->employmenttype_id=$request->employmenttype_id;
        $navy->chassis_number = $request->chassis_number    ;
        $navy->year_making = $request->year_making;
        $navy->spare_serial = $request->spare_serial;
        $navy->expire_insurance = $request->expire_insurance;
        $navy->expire_technical = $request->expire_technical;
        $navy->driver_id = $request->driver_id;
        $navy->age_car = $request->age_car;
        $navy->plate_serial = $request->plate_serial;
        $navy->camiontype_id = $request->camiontype_id;
        $navy->motor_number = $request->motor_number;
        $navy->veterinary_code = $request->veterinary_code;
        $navy->status = $request->status;
        $navy->capacity = $request->capacity;
        $navy->save();
        return response()->json(['data' => null , 'massage' => 'تغییرات با موفقیت اعمال شد.' , 'status' => 200], $this->successStatus);

    }

    public function searchfindnavyplate(Request $request)
    {
        $navy = Navy::with('driver')->where('plates_number', 'LIKE', '%' . $request->platesnumber . '%')->get();
        return response()->json(['data' => ['navy'=>$navy] , 'massage' => 'دریافت اطلاعات راننده.' , 'status' => 200], $this->successStatus);
    }

}
