<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroVenta extends Model
{
    use HasFactory;
    protected $table = 'registro_venta';
    protected $primaryKey = 'cod';

    protected $fillable = [ // Atributos que se pueden llenar masivamente
        'precio_venta',
        'cod_calzado',
        'nro_venta',
    ];

    // Relación con el modelo Calzado
    public function calzado()
    {
        return $this->belongsTo(Calzado::class, 'cod_calzado', 'cod');
    }

    // Relación con el modelo NotaVenta
    public function notaventa()
    {
        return $this->belongsTo(NotaVenta::class, 'nro_venta', 'nro');
    }
}
