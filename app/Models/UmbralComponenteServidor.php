<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmbralComponenteServidor extends Model
{
    use HasFactory;

    protected $table = 'Umbral_Componente_Servidor';
    protected $primaryKey = 'IdParametro';
}
