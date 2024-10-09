<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calzado extends Model
{
    use HasFactory;
    protected $table = 'calzado';
    protected $primaryKey = 'cod';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [ // Atributos que se pueden llenar masivamente
        'cod',
        'genero',
        'precio_unidad',
        'cantidad_pares',
        'cod_lote',
        'cod_modelo',
        'cod_talla',
        'cod_material',
    ];

    public function getGeneroCompletoAttribute()
    {
        switch ($this->genero) {
            case 'm':
                return 'Masculino';
            case 'f':
                return 'Femenino';
            case 'u':
                return 'Unisex';
            default:
                return 'No definido';
        }
    }

    public function loteMercaderia()
    {
        return $this->belongsTo(LoteMercaderia::class, 'cod_lote', 'cod');
    }

    // Relación con el modelo Modelo
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'cod_modelo', 'cod');
    }

    // Relación con el modelo Talla
    public function talla()
    {
        return $this->belongsTo(Talla::class, 'cod_talla', 'cod');
    }

    // Relación con el modelo Material
    public function material()
    {
        return $this->belongsTo(Material::class, 'cod_material', 'cod');
    }

    
}