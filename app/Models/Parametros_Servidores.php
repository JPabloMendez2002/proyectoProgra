<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametros_Servidores extends Model
{
    use HasFactory;

    protected $table = 'Parametros_Servidores';
    protected $primaryKey = 'IdParametroServidor';
    protected $fillable = ['Nombre','Descripcion'];
}
