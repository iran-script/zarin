<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\City;
use App\Bank;
use App\EmploymentType;
class UtilityController extends Controller
{
	public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function getprovince()
    {
    	$city = City::where('type',0)->get();
    	return response()->json(['data' => $city , 'massage' => 'دریافت لیست استان ها.' , 'status' => 200], $this->successStatus);
    }

    public function getcity(Request $request)
    {
        $city = City::where('parent_id',$request->province_id)->get();
        return response()->json(['data' => $city , 'massage' => 'دریافت لیست استان ها.' , 'status' => 200], $this->successStatus);
    }  
    public function getarea(Request $request)
    {
        $area = City::where('parent_id',$request->city_id)->get();
        return response()->json(['data' => $area , 'massage' => 'دریافت لیست استان ها.' , 'status' => 200], $this->successStatus);
    }  
    public function getemploymnettype(Request $request)
    {
        $employmetntype = EmploymentType::get();
        return response()->json(['data' => $employmetntype , 'massage' => 'دریافت لیست نوع همکاری.' , 'status' => 200], $this->successStatus);
    }  
    public function getlistbank(Request $request)
    {
        $bank = Bank::get();
        return response()->json(['data' => $bank , 'massage' => 'دریافت لیست بانک ها.' , 'status' => 200], $this->successStatus);
    }    
}
