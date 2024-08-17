<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CateringCategory extends Model
{
    use HasFactory;
    
    protected $table = "catering_categories";

    protected $fillable = ['name', 'description', 'image', 'status']; 

    public function catering(){
        return $this->hasMany(Catering::class); 
    }
    
}
