<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCoupon extends Model
{
    use HasFactory;
    
    protected $table = "coupons_customers";
    
    protected $fillable = ['customer_id', 'coupon_id', 'redemptiondate', 'user_id', 'status']; 

    public function customer(){
        return  $this->belongsTo(Customer::class);
    }
    
    public function coupon(){
        return  $this->belongsTo(Coupon::class);
    }
    
    public function user(){
        return  $this->belongsTo(User::class);
    }

}
