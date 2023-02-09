<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoreoServidor extends Model
{
    use HasFactory;

    protected $table = 'Monitoreo_Servidor';
    protected $primaryKey = 'IdMonitoreoServidor';
}
