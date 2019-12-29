<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::group(['namespace' => 'API'], function () {
    Route::post('api/sendsms', 'UserController@sendsms');
    Route::any('api/login', 'UserController@login');
    Route::get('api/register', 'UserController@register');
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::get('api/getusers', 'UserController@getusers')->name('getusers')->middleware('UsersRoutes');
    Route::get('api/getuserinfo', 'UserController@getuserinfo');
    Route::post('api/getuser', 'UserController@getuser')->name('getuser')->middleware('RoleAdmin');
    Route::post('api/adduser', 'UserController@adduser')->name('adduser')->middleware('UsersRoutes');
    Route::post('api/updateuser', 'UserController@updateuser')->name('updateuser')->middleware('UsersRoutes');
    Route::get('api/getroles', 'UserController@getroles')->middleware('RoleAdmin');
    Route::post('api/getrolesuser', 'UserController@getrolesuser')->middleware('RoleAdmin');
    Route::post('api/addrole', 'UserController@addrole')->middleware('RoleAdmin');
    Route::post('api/getuserroutelist', 'UserController@getuserroutelist');
    //Route::get('api/getroutelist', 'UserController@getroutelist')->name('getroutelist');
    Route::post('api/editrouteuser', 'UserController@editrouteuser');

    
});

Route::group(['middleware' => ['auth:api'],'namespace' => 'API'], function () {
    Route::post('api/getprovince', 'UtilityController@getprovince');
    Route::get('api/getemploymnettype', 'UtilityController@getemploymnettype');
    Route::get('api/getlistbank', 'UtilityController@getlistbank');
    Route::post('api/getcity', 'UtilityController@getcity');
    Route::post('api/getarea', 'UtilityController@getarea');
});


Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/adddriver', 'DriverController@adddriver')->middleware('UsersRoutes');
    Route::post('api/updatedriver', 'DriverController@updatedriver')->middleware('RoleAdmin');
    Route::post('api/getdrivers', 'DriverController@getdrivers')->middleware('UsersRoutes');
    Route::post('api/getalldrivers', 'DriverController@getalldrivers')->middleware('RoleAdmin');
    Route::post('api/getdriver', 'DriverController@getdriver')->middleware('RoleAdmin');
    Route::post('api/search/finddriver', 'DriverController@searchfinddriver')->middleware('RoleAdmin');

});


Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/addnavy', 'NavyController@addnavy')->middleware('RoleAdmin');
    Route::post('api/getnavylist', 'NavyController@getnavylist')->middleware('RoleAdmin');
    Route::post('api/getnavy', 'NavyController@getnavy')->middleware('RoleAdmin');
    Route::post('api/updatenavy', 'NavyController@updatenavy')->middleware('RoleAdmin');
    Route::post('api/search/findnavyplate', 'NavyController@searchfindnavyplate')->middleware('RoleAdmin');

});


Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/addbaker', 'BakerController@addbaker')->middleware('RoleAdmin');
    Route::post('api/getbakers', 'BakerController@getbakers')->middleware('RoleAdmin');
    Route::post('api/getbaker', 'BakerController@getbaker')->middleware('RoleAdmin');
    Route::post('api/updatebaker', 'BakerController@updatebaker')->middleware('RoleAdmin');
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/getflourfactory', 'FlourfactoryController@getflourfactory')->middleware('RoleAdmin');
    Route::post('api/getallfactoryflour', 'FlourfactoryController@getallfactoryflour')->middleware('RoleAdmin');
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/getdepositingreceipt', 'DepositController@getdepositingreceipt')->middleware('RoleAdmin');
    Route::post('api/adddepositingexcel', 'DepositController@adddepositingexcel')->middleware('RoleAdmin');
    Route::post('api/getdepositservice', 'DepositController@getdepositservice')->middleware('RoleAdmin');
    Route::post('api/getalldepositfactory', 'DepositController@getalldepositfactory')->middleware('RoleAdmin');
    
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/addservice', 'ServiceController@addservice')->middleware('RoleAdmin');
    Route::post('api/getservices', 'ServiceController@getservices')->middleware('RoleAdmin');
    Route::post('api/getservice', 'ServiceController@getservice')->middleware('RoleAdmin');
    Route::post('api/updatetotalpriceservice', 'ServiceController@updatetotalpriceservice')->middleware('RoleAdmin');
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/addordertoservice', 'OrdersController@addordertoservice')->middleware('RoleAdmin');
    Route::post('api/removeorderfromservice', 'OrdersController@removeorderfromservice')->middleware('RoleAdmin');
    Route::post('api/getallorders', 'OrdersController@getallorders')->middleware('RoleAdmin');
    Route::post('api/getorder', 'OrdersController@getorders')->middleware('RoleAdmin');
    Route::post('api/getorder', 'OrdersController@getorder')->middleware('RoleAdmin');
    Route::post('api/verifyorder', 'OrdersController@verifyorder')->middleware('RoleAdmin');
    Route::post('api/printordersservice', 'OrdersController@printordersservice')->middleware('RoleAdmin');
    
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/getdriverlistreport', 'ReportDriversController@getdriverlistreport')->middleware('RoleAdmin');
    Route::post('api/getdetailservicereport', 'ReportDriversController@getdetailservicereport')->middleware('RoleAdmin');
    Route::post('api/exportreportdriver', 'ReportDriversController@exportreportdriver')->middleware('RoleAdmin');
    
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/exportreportbaker', 'ReportBakersController@exportreportbaker')->middleware('RoleAdmin');
    
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/search/findbankaccountcompany', 'PaymentDriverController@searchfindaccountcompany')->middleware('RoleAdmin');
    Route::post('api/getaccountingpricedrivers', 'PaymentDriverController@getaccountingpricedrivers')->middleware('RoleAdmin');
    Route::post('api/addpaymentdriver', 'PaymentDriverController@addpaymentdriver')->middleware('RoleAdmin');
    Route::post('api/verifyaccountingpaymentdriver', 'PaymentDriverController@verifyaccountingpaymentdriver')->middleware('RoleAdmin');
    
});

Route::group(['middleware' => ['auth:api','UsersRoutes'],'namespace' => 'API'], function () {
    Route::post('api/getalldirectionlist', 'DirectionController@getalldirectionlist')->middleware('RoleAdmin');
    Route::post('api/adddirectionprice', 'DirectionController@adddirectionprice')->middleware('RoleAdmin');

});








