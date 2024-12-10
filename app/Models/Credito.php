<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $table = 'credito';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'nro_venta',
        'fecha',
        'monto_c',
    ];

    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class, 'nro_venta', 'nro');
    }
}