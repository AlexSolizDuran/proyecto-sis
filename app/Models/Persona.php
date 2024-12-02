<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Persona extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;
    //nombre de la tabla
    protected $table = 'persona';
    protected $primaryKey = 'ci';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'ci',
        'nombre',
        'apellido',
        'email',
        'direccion',
        'password',
        'cel',
        'tipo',
    ];

    public function getNombreAttribute($value)
    {
        return ucwords(strtolower($value));
    }
    public function getApellidoAttribute($value)
    {
        return ucwords(strtolower($value));
    }
    protected $hidden = [
        'password', // Ocultar el password al serializar
    ];
    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'ci_persona', 'ci');
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class, 'ci_persona', 'ci');
    }

    /**
     * Método para obtener la contraseña dependiendo del tipo de usuario.
     */
    public function getAuthPassword()
    {
        return $this->password;
    }


}
