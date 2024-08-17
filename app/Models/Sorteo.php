<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorteo extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre', 'descripcion', 'valor_boleta', 'fecha_sorteo', 'fecha_inicio', 'fecha_fin', 'premio']; 

    public function boletas()
    {
        return $this->hasMany(Boleta::class);
    }
    
}