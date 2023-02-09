<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametros_Servicios extends Model
{
    use HasFactory;

    protected $table = 'Parametros_Servicios';
    protected $primaryKey = 'IdParametroServicio';
    protected $fillable = ['Nombre','Descripcion'];
}
