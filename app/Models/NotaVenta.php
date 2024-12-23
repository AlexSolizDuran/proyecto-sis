<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;

    protected $table = 'nota_venta';
    protected $primaryKey = 'nro';
    public $timestamps = false;

    protected $fillable = [
        'fecha',
        'monto_total',
        'cantidad',
        'estado',
        'ci_cliente',
        'cod_admin',
        'descuento_total',
        'tipo_pago'
    ];
    public function getEstado()
    {
        switch ($this->estado) {
            case '1':
                return 'CANCELADO';
            case '0':
                return 'PENDIENTE';
            default:
                return 'No definido';
        }
    }
    public function getPago()
    {
        switch ($this->tipo_pago) {
            case 'c':
                return 'CONTADO';
            case 'k':
                return 'CREDITO';
            default:
                return 'No definido';
        }
    }

    public function cliente (){
        return $this->belongsTo(Cliente::class, 'ci_cliente','ci_persona');
    }
    public function administrador(){
        return $this->belongsTo(Administrador::class, 'cod_admin', 'cod');
    }
    public function registroventa()
    {
        return $this->hasMany(RegistroVenta::class, 'nro_venta', 'nro');
    }
    public function creditos()
    {
        return $this->hasMany(Credito::class, 'nro_venta', 'nro');
    }

}
