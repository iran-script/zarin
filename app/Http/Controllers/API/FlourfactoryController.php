<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FlourFactory;
class FlourfactoryController extends Controller
{
	public $successStatus = 200;

    public function getflourfactory(Request $request)
    {
    	$pageindex = $request->pageindex;
        $limit = $request->limit;
        $flourfactorycount= FlourFactory::count();
    	$flourfactory= FlourFactory::with('city')->skip(($pageindex-1)*$limit)->take($limit)->get();
    	return response()->json(['data' => ['flourfactorylist'=>$flourfactory,'flourfactorycount'=>$flourfactorycount] , 'massage' => 'دریافت لیست کارخانجات آرد.' , 'status' => 200], $this->successStatus);

    }
    
    public function getallfactoryflour(Request $request)
    {
    	$flourfactory=FlourFactory::get();
    	return response()->json(['data' => ['flourfactory'=>$flourfactory] , 'massage' => 'دریافت لیست کارخانجات آرد.' , 'status' => 200], $this->successStatus);

    }
}
