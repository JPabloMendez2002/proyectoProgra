<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IniciarDetenerServicio extends Model
{
    use HasFactory;
    protected $table = 'Encargo_Servicio';
    protected $primaryKey = 'IdEncargado';
}
