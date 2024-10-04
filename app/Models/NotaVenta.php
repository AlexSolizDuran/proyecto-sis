<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;

    protected $table = 'nota_venta';
    protected $primaryKey = 'nro';

    protected $filliable = ['fecha','monto_total','cantidad','ci_cliente','cod_admin',];

    public function cliente (){
        return $this->belongsTo(Cliente::class, 'ci_cliente','ci_persona');
    }
    public function administrador(){
        return $this->hasMany(Administrador::class, 'cod_admin','cod');
    }
    public function registroventa(){
        return $this->hasMany(RegistroVenta::class,'nro_venta','nro');
    }
}
