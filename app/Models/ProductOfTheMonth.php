<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOfTheMonth extends Model
{
    use HasFactory;
    
    protected $table = 'monthproducts';
    protected $fillable = ['product_id', 'photo', 'title', 'promo', 'startdate', 'enddate'	, 'status']; 

    public function  product(){
        return  $this->belongsTo(Product::class);
    }

}
