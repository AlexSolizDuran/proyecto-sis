<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    use HasFactory;

    protected $table = 'resena';
    
    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'nro_reg',
        'comentario',
        'estrella',
    ];

    public function registroVenta()
{
    return $this->belongsTo(RegistroVenta::class, 'nro_reg','cod'); // Usa el nombre correcto de la columna
}
}
