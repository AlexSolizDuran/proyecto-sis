<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $table = 'modelo';
    protected $primaryKey = 'cod';

    protected $fillable = ['nombre','cod_marca',];

    public function marca(){
        return $this->belongsTo(Marca::class, 'cod_marca','cod');
    }
}
