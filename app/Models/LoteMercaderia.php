<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteMercaderia extends Model
{
    use HasFactory;
    protected $table = 'lote_mercaderia';
    protected $primaryKey = 'cod';
    public $incrementing = true;

    protected $fillable = [ // Atributos que se pueden llenar masivamente
        'cod',
        'cantidad_total_pares',
        'impuestos',
        'costo_compra',
        'fecha_compra',
        'costo_logistica',
        'cod_marca',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'cod_marca', 'cod');
    }
    public function registrolote()
    {
        return $this->hasMany(RegistroLote::class, 'cod_lote', 'cod');
    }   

}
