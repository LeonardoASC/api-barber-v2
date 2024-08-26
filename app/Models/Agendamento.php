<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    use HasFactory;
    protected $table = 'agendamentos';
    protected $fillable = [
        'nome',
        'dia',
        'horario',
        'preco',
        'tipo_servico',
        'servico_especifico',
        'status',
        'user_id',
        'notification_sent',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
