<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorCalzado extends Model
{
    use HasFactory;

    protected $table = 'color_calzado'; // Nombre de la tabla
    public $timestamps = false; // No usar timestamps

    protected $primaryKey = ['cod_calzado', 'cod_color']; // Llave primaria compuesta
    public $incrementing = false; // Indica que no es auto-incrementable
    protected $keyType = 'array'; // Tipo de clave es array

    protected $fillable = [
        'cod_calzado',
        'cod_color',
    ];

    // Relación con Calzado
    public function calzado()
    {
        return $this->belongsTo(Calzado::class, 'cod_calzado', 'cod');
    }

    // Relación con Color
    public function color()
    {
        return $this->belongsTo(Color::class, 'cod_color', 'cod');
    }

}
