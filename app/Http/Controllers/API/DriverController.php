<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\Drivers;
use App\Bank;
use App\EmploymentType;
use App\TotalPriceDriver;

class DriverController extends Controller
{
	public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function adddriver(Request $request)
    {
    	$drivers = new Drivers;
        $drivers->smart_id = $request->smart_id;
    	$drivers->employmenttype_id = $request->employmenttype_id;
    	$drivers->personel_code = $request->personel_code;
    	$drivers->national_code = $request->national_code;
    	$drivers->first_name = $request->first_name;
    	$drivers->last_name = $request->last_name;
    	$drivers->father_name = $request->father_name;
        $drivers->birth_number = $request->birth_number;
    	$drivers->birth_place = $request->birth_place;
    	$drivers->birthday = $request->birthday;
    	$drivers->mobile = $request->mobile;
    	$drivers->phone = $request->phone;
    	$drivers->cert_number = $request->cert_number;
    	$drivers->expire_healthcard = $request->expire_healthcard;
    	$drivers->expire_smartcard = $request->expire_smartcard;
    	$drivers->postal_code = $request->postal_code;
    	$drivers->address = $request->address;
    	$drivers->sheba_number = $request->sheba_number;
    	$drivers->bank_account_number = $request->bank_account_number;
        $drivers->bank_id = $request->bank_id;
    	$drivers->cert_city = $request->cert_city;
    	$drivers->persent_insurance_driver = $request->persent_insurance_driver;
    	$drivers->persent_tax = $request->persent_tax;
    	$drivers->persent_fractions = $request->persent_fractions;
    	$drivers->persent_goodjob = $request->persent_goodjob;
    	$drivers->status = $request->status;
    	$drivers->save();

        $totalpricedriver = new TotalPriceDriver;
        $totalpricedriver->driver_id = $drivers->id;
        $totalpricedriver->totalprice = 0;
        $totalpricedriver->save();
    	return response()->json(['data' => null , 'massage' => 'راننده با موفقیت اضافه شد.' , 'status' => 200], $this->successStatus);
    }

    public function updatedriver(Request $request)
    {
    	$drivers =Drivers::find($request->id);

    	$drivers->smart_id = $request->smart_id;
    	$drivers->personel_code = $request->personel_code;
    	$drivers->national_code = $request->national_code;
    	$drivers->first_name = $request->first_name;
    	$drivers->last_name = $request->last_name;
    	$drivers->employmenttype_id = $request->employmenttype_id;
    	$drivers->father_name = $request->father_name;
    	$drivers->birth_number = $request->birth_number;
    	$drivers->birth_place = $request->birth_place;
    	$drivers->cert_city = $request->cert_city;
    	$drivers->birthday = $request->birthday;
    	$drivers->mobile = $request->mobile;
    	$drivers->phone = $request->phone;
    	$drivers->cert_number = $request->cert_number;
    	$drivers->expire_healthcard = $request->expire_healthcard;
    	$drivers->expire_smartcard = $request->expire_smartcard;
    	$drivers->postal_code = $request->postal_code;
    	$drivers->address = $request->address;
    	$drivers->sheba_number = $request->sheba_number;
    	$drivers->bank_account_number = $request->bank_account_number;
    	$drivers->bank_id = $request->bank_id;
    	$drivers->persent_insurance_driver = $request->persent_insurance_driver;
    	$drivers->persent_tax = $request->persent_tax;
    	$drivers->persent_fractions = $request->persent_fractions;
    	$drivers->persent_goodjob = $request->persent_goodjob;
    	$drivers->status = $request->status;
    	$drivers->save();
    	return response()->json(['data' => null , 'massage' => 'راننده با موفقیت اضافه شد.' , 'status' => 200], $this->successStatus);
    }

    public function getdrivers(Request $request)
    {
    	$pageindex = $request->pageindex;
    	$limit = $request->limit;
        $driverscount= Drivers::count();
    	$drivers = Drivers::with('bank')->with('employmenttype')->skip(($pageindex-1)*$limit)->take($limit)->get();
    	return response()->json(['data' => ['driverslist'=>$drivers,'driverscount'=>$driverscount] , 'massage' => 'لیست کل رانندگان.' , 'status' => 200], $this->successStatus);
    }

    public function getalldrivers(Request $request)
    {
        $drivers = Drivers::select('id','first_name','last_name')->get();
        return response()->json(['data' => ['driverslist'=>$drivers] , 'massage' => 'لیست کل رانندگان.' , 'status' => 200], $this->successStatus);
    }

     public function getdriver(Request $request)
    {
        $banklist = Bank::get();
        $employmentlist = EmploymentType::get();
        $drivers = Drivers::with('bank')->with('employmenttype')->find($request->driver_id);
        return response()->json(['data' => ['driverlist'=>$drivers,'banklist'=>$banklist,'employmentlist'=>$employmentlist] , 'massage' => 'دریافت اطلاعات راننده.' , 'status' => 200], $this->successStatus);
    }

    public function searchfinddriver(Request $request)
    {
        $driver = Drivers::with('navy')->where('first_name', 'LIKE', '%' . $request->name . '%')->orWhere('last_name', 'LIKE', '%' . $request->name . '%')->get();
        return response()->json(['data' => ['drivers'=>$driver] , 'massage' => 'دریافت اطلاعات راننده.' , 'status' => 200], $this->successStatus);
    }
}
