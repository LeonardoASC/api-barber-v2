<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubServico extends Model
{
    use HasFactory;
    protected $table = 'sub_servicos';
    protected $fillable = ['name', 'preco', 'tempo_de_duracao', 'imagem', 'servico_id'];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
