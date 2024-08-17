<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catering extends Model
{
    use HasFactory;
    
    protected $table = "catering";
    
    protected $fillable = ['name', 'description', 'image', 'bestseller', 'status', 'price', 'category_id']; 

    public function catering_category(){
        return $this->belongsTo(CateringCategory::class, 'category_id');
    }

}
