<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervalo extends Model
{
    use HasFactory;

    protected $table = 'Intervalos';
    protected $primaryKey = 'IdIntervalo';

    protected $fillable = ['Nombre','Descripcion'];
}
