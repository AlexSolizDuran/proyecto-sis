<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'ci_persona';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['ci_persona','direccion','gmail',];
    
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'ci_persona', 'ci');
    }

    public function notaVentas()
    {
        return $this->hasMany(NotaVenta::class, 'ci_cliente', 'ci_persona');
    }
}
