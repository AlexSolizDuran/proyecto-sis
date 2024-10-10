<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorCalzado extends Model
{
    use HasFactory;
    protected $table = ['cod_calzado', 'cod_color'];
    
    protected $fillable = [ // Atributos que se pueden llenar masivamente
        'cod_calzado',
        'cod_color',
    ];

    // Relación con el modelo Calzado
    public function calzado()
    {
        return $this->belongsTo(Calzado::class, 'cod_calzado', 'cod');
    }

    // Relación con el modelo Color
    public function color()
    {
        return $this->belongsTo(Color::class, 'cod_color', 'cod');
    }

}
