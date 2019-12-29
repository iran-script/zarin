<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Hash;
use App\User;
use App\Roles;
use App\Routes;
use App\UsersRolesRelation;
use App\UsersRoutesRelation;
class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function sendsms(Request $request)
    {
       $user=User::where('mobile',$request->mobile)->first();
       if($user)
       {
        // $verifycode = mt_rand(1000, 9999);
        $verifycode = 123456;
        $user->password=Hash::make($verifycode);
        $user->save();
        return response()->json(['data' => $verifycode ,'massage'=>'کد را وارد نمایید.','status' => 200], 200);
       }
       else{
            return response()->json(['data' => null ,'massage'=>'شماره معتبر نمی باشد.','status' => 401], 401);
        }
    }
    public function login(){
        if(Auth::attempt(['mobile' => request('mobile'), 'password' => request('password') , 'user_status' => 1])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['data' => ['token'=>$success,'userinfo'=> User::find(Auth::id())] , 'massage' => 'احراز هویت موفقیت آموز بود' , 'status' => 200], $this->successStatus);
        }
        else{
            return response()->json(['data' => null ,'massage'=>'لاگین موفقیت آموز نبود.' ,'status' => 401], 401 );
        }
    }


    public function getusers(Request $request)
    {
        $roles =  User::with('roles')->get();
        return response()->json(['data' => $roles, 'massage' => 'دریافت لیست کاربران' , 'status' => 200], $this->successStatus);
    }

    public function adduser(Request $request)
    {
     $user = new User;
     $user->first_name=$request->first_name;
     $user->last_name=$request->last_name;
     $user->mobile=$request->mobile;
     $user->email=$request->email;
     $user->user_status=$request->user_status;
     $user->phone=$request->phone;
     $user->address=$request->address;
     $user->user_status=1;
     $user->save();
     return response()->json(['data' => null , 'massage' => 'کاربر با موفقیت اضافه شد.' , 'status' => 200], $this->successStatus);
 }

 public function getuser(Request $request)
 {
     $user=User::with('roles')->find($request->user_id);
     return response()->json(['data' => $user , 'massage' => 'دریافت اطلاعات کاربر.' , 'status' => 200], $this->successStatus);
 }

 public function updateuser(Request $request)
 {
     $user = User::find($request->user_id);
     $user->first_name=$request->first_name;
     $user->last_name=$request->last_name;
     $user->email=$request->email;
     $user->user_status=$request->user_status;
     $user->phone=$request->phone;
     $user->address=$request->address;
     $user->save();
     return response()->json(['data' => null , 'massage' => 'کاربر با موفقیت ویرایش گردید.' , 'status' => 200], $this->successStatus);
 }

 public function getroles(Request $request)
 {
     $roles=Roles::get();
     return response()->json(['data' => $roles , 'massage' => 'دریافت لیست نقش ها.' , 'status' => 200], $this->successStatus);
 }

 public function getrolesuser(Request $request)
 {
     $rolesuser=User::find($request->user_id)->roles;
     return response()->json(['data' => $rolesuser , 'massage' => 'دریافت نقش های کاربر.' , 'status' => 200], $this->successStatus);

 }

 public function addrole(Request $request)
 {
    $urr= UsersRolesRelation::where('user_id',$request->user_id)->delete();
    foreach ($request->role_id as $role) {
        if ($role != 1) {
        $user_roles_relation = new UsersRolesRelation;
        $user_roles_relation->role_id = $role;
        $user_roles_relation->user_id = $request->user_id;
        $user_roles_relation->save();
        }
       
    }
    return response()->json(['data' => null , 'massage' => 'نقش به کاربر اضافه شد.' , 'status' => 200], $this->successStatus);
 }

 public function getuserroutelist(Request $request)
 {
     $userroute = User::find($request->user_id)->routes;
    return response()->json(['data' => ['userroutelist'=>$userroute] , 'massage' => 'دریفات روت های دسترسی کاربر.' , 'status' => 200], $this->successStatus);
     
 }
 // public function getroutelist()
 // {
 //    $routelist = User::find(Auth::id())->routes->groupBy('category');
 //    return response()->json(['data' => $routelist , 'massage' => 'دریافت لیست روت های کاربر لاگین شده.' , 'status' => 200], $this->successStatus);
 // }
 public function editrouteuser(Request $request)
 {
    $urr = UsersRoutesRelation::where('user_id',$request->user_id)->delete();
    foreach ($request->route_name as $route) {
        $route = Routes::Where('name',$route)->first();
        $users_routes_relation = new UsersRoutesRelation;
        $users_routes_relation->user_id = $request->user_id;
        $users_routes_relation->route_id = $route->id;
        $users_routes_relation->save();
    } 
    return response()->json(['data' => null , 'massage' => 'روت ها به کاربر اضافه شد.' , 'status' => 200], $this->successStatus);
 }

}
