<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;
    
    protected $fillable = ['numero', 'cliente_id', 'vendedor_id', 'sorteo_id', 'saldo']; 

    public function sorteo(){
        return $this->belongsTo(Sorteo::class);
    }

}
