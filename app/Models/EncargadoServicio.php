<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncargadoServicio extends Model
{
    use HasFactory;
    protected $table = 'Encargo_Servicio';
    protected $primaryKey = 'IdEncargado';
}
