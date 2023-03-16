<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertasServidor extends Model
{
    use HasFactory;

    protected $table = 'Alertas_Servidor';
    protected $primaryKey = 'IdServidor';
}
