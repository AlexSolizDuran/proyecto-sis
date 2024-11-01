<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'bitacora';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'ip',
        'accion',
        'fecha',
        'hora',
        'ci', // Relación con la tabla persona
    ];

    // Definir la relación con el modelo Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class); // Asegúrate de que 'Persona' es el modelo correcto
    }
}
