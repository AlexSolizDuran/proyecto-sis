<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;
    protected $table = 'administrador';
    protected $primaryKey = 'cod';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['cod','ci_persona',];

    public function persona(){
        return $this->belongsTo(Persona::class, 'ci_persona','ci');
    }

    public function notaVentas(){
        return $this->hasMany(NotaVenta::class, 'cod_admin','cod');
    }
}
