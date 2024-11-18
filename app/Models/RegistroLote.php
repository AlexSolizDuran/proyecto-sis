<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroLote extends Model
{
    use HasFactory;
    
    protected $table = 'registro_lote';

    protected $primaryKey = ['cod_calzado', 'cod_lote'];
    public $incrementing = false; 
    protected $fillable = ['cod_calzado', 'cod_lote', 'cantidad', 'costo_unitario'];
    public $timestamps = false;

    // Sobrescribe este método para que trabaje con clave compuesta
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public function loteMercaderia()
    {
        return $this->belongsTo(LoteMercaderia::class, 'cod_lote', 'cod');
    }
    
    public function calzado()
    {
        return $this->belongsTo(Calzado::class, 'cod_calzado', 'cod');
    }
}

