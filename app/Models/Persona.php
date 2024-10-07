<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    //nombre de la tabla
    protected $table = 'persona';
    //clave primaria
    protected $primaryKey = 'ci';
    public $incrementing = false;
    public $timestamps = false;
    
    protected $fillable = ['ci','nombre','apellido','cel','tipo',];


    public function administrador(){
        return  $this->hasOne(Administrador::class, 'ci_persona','ci');
    }

    public function cliente(){
        return $this->hasOne(Cliente::class, 'ci_persona','ci');
    }


}
