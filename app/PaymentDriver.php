<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDriver extends Model
{
    //payment_driver
     protected $table = 'payment_driver';
    
    public function type_payment() {
        return $this->belongsTo('App\TypePayment','type_payment_id');
    }
    public function bank() {
        return $this->belongsTo('App\Bank','bank_id');
    }
    public function driver() {
        return $this->belongsTo('App\Drivers','driver_id');

    }
    public function user() {
        return $this->belongsTo('App\User','user_id');

    }
    public function bankaccountcompany() {
        return $this->belongsTo('App\BankAccountCompany','bank_account_company_id');

    }

     public function totalpricedriver() {
        return $this->belongsTo('App\TotalPriceDriver','driver_id','driver_id');

    }
}
