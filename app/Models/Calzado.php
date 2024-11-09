<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calzado extends Model
{
    use HasFactory;
    protected $table = 'calzado';
    protected $primaryKey = 'cod';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [ // Atributos que se pueden llenar masivamente
        'genero',
        'precio_unidad',
        'cantidad_pares',
        'imagen',
        'cod_modelo',
        'cod_talla',
        'cod_material',
    ];

    public function getGeneroCompleto()
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
    
    public function colorCalzados()
    {
        return $this->hasMany(ColorCalzado::class, 'cod_calzado', 'cod');
    }

    // Relación con Color a través de ColorCalzado
    public function colores()
    {
        return $this->belongsToMany(Color::class, 'color_calzado', 'cod_calzado', 'cod_color');
    }

}
