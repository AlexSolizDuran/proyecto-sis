<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroLote extends Model
{
    use HasFactory;
    
    protected $table = 'registro_lote';

    protected $primaryKey = ['cod_calzado', 'cod_lote'];
    protected $fillable = ['cod_calzado', 'cod_lote', 'cantidad'];
    public $timestamps = false;

    public function calzado()
    {
        return $this->belongsTo(Calzado::class, 'cod_calzado');
    }

    public function loteMercaderia()
    {
        return $this->belongsTo(LoteMercaderia::class, 'cod_lote');
    }
}
