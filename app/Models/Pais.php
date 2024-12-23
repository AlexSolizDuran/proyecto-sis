<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table = 'pais';
    protected $primaryKey = 'cod';
    protected $keyType = 'string';
    public $timestamps = false;
    
    protected $fillable = ['cod','nombre','horma'];


}
