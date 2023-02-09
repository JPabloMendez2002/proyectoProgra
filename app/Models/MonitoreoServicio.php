<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoreoServicio extends Model
{
    use HasFactory;

    protected $table = 'Monitoreo_Servicio';
    protected $primaryKey = 'IdMonitoreoServicio';
}
