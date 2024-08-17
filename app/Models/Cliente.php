<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'email', 'telefono', 'direccion', 'fecha_inicio', 'customer_key']; 

    public function clientes()
    {
        return $this->hasMany(Boleta::class);
    }
    
}