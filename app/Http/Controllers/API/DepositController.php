<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Deposit;
use App\Orders;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DepositImport;
use App\Http\Controllers\API\Input;
use Verta;
use Carbon;
use App\FlourFactory;

class DepositController extends Controller
{
    public $successStatus = 200;

    public function getdepositingreceipt(Request $request)
    {
        $pageindex = $request->pageindex;
        $limit = $request->limit;
    	$depositlist = Deposit::with('flourfactory')->with('baker')->with('city')->skip(($pageindex-1)*$limit)->take($limit)->get();
        $depositcount = Deposit::count();
        return response()->json(['data' => ['depositlist'=>$depositlist,'depositcount'=>$depositcount] , 'massage' => 'دریافت لیست فیش های واریزی.' , 'status' => 200], $this->successStatus);
    }

    public function adddepositingexcel(Request $request)
    {
    	$file = $request->file('file');
    	Excel::import(new DepositImport, $file);
        return response()->json(['data' => null , 'massage' => 'فایل با موفقیت آپلود شد.' , 'status' => 200], $this->successStatus);
    }

    public function getdepositservice(Request $request)
    {
       $deposit=Deposit::where('city_id',$request->city_id)->where('flourfactory_id',$request->factory_id)->where('status',0)->with('flourfactory')->with('baker')->with('city')->get();
       return response()->json(['data' => ['orderslist'=>$deposit] , 'massage' => 'لیست فیش های واریزی مربوط به سرویس.' , 'status' => 200], $this->successStatus);
    }
    public function getalldepositfactory(Request $request)
    {
        $pageindex = $request->pageindex;
        $limit = $request->limit;
        $flourfactory = FlourFactory::find($request->factory_id);
        $depositcount=Deposit::where('flourfactory_id',$flourfactory->smart_id)->count();
        $depositlist=Deposit::where('flourfactory_id',$flourfactory->smart_id)->where('status',0)->with('flourfactory')->with('baker')->with('city')->orderBy('id','desc')->skip(($pageindex-1)*$limit)->take($limit)->get();
        return response()->json(['data' => ['depositlist'=>$depositlist,'depositcount'=>$depositcount] , 'massage' => 'لیست فیش های واریزی مربوط به کارخانه.' , 'status' => 200], $this->successStatus);
    }

    
}
