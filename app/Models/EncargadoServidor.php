<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncargadoServidor extends Model
{
    use HasFactory;
    protected $table = 'Encargado_Servidor';
    protected $primaryKey = 'IdEncargado';
}