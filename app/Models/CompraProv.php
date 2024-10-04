<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProv extends Model
{
    use HasFactory;
    protected $table = 'compra_prov';

    protected $fillable = [ // Atributos que se pueden llenar masivamente
        'cod_lote',
        'cod_pais',
        'NIT',
        'nombre',
    ];

    // Relación con el modelo LoteMercaderia
    public function loteMercaderia()
    {
        return $this->belongsTo(LoteMercaderia::class, 'cod_lote', 'cod');
    }

    // Relación con el modelo Pais
    public function pais()
    {
        return $this->belongsTo(Pais::class, 'cod_pais', 'cod');
    }
}
