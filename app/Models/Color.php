<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'color';
    protected $primaryKey = 'cod';
    public $timestamps = false;
    protected $fillable = ['nombre','codigo_color',];

    public function colorCalzados()
    {
        return $this->hasMany(ColorCalzado::class, 'cod_color', 'cod');
    }
}
