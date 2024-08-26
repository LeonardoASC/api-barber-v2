<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioPersonalizado extends Model
{
    use HasFactory;
    protected $fillable = ['data_inicial', 'data_final', 'hora_inicial', 'hora_final'];
}
