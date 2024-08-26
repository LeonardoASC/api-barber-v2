<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dia;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dias = [
            ['codigo_dia' => '0', 'dia' => 'Domingo', 'status' => 'inativo'],
            ['codigo_dia' => '1', 'dia' => 'Segunda-feira', 'status' => 'inativo'],
            ['codigo_dia' => '2', 'dia' => 'Terça-feira', 'status' => 'ativo'],
            ['codigo_dia' => '3', 'dia' => 'Quarta-feira', 'status' => 'ativo'],
            ['codigo_dia' => '4', 'dia' => 'Quinta-feira', 'status' => 'ativo'],
            ['codigo_dia' => '5', 'dia' => 'Sexta-feira', 'status' => 'ativo'],
            ['codigo_dia' => '6', 'dia' => 'Sábado', 'status' => 'ativo'],
        ];

        foreach ($dias as $dia) {
            Dia::create($dia);
        }
    }
}
