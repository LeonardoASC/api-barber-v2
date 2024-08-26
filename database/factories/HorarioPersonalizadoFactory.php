<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HorarioPersonalizado>
 */
class HorarioPersonalizadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Gerar a data inicial a partir do ano atual
        $dataInicio = Carbon::instance($this->faker->dateTimeThisYear);

        // Garantir que a data final seja pelo menos 1 dia depois da data inicial
        $dataFim = (clone $dataInicio)->addDay();

        // Gerar a hora inicial
        $horaInicial = $dataInicio->setTime(
            $this->faker->numberBetween(0, 23),
            $this->faker->numberBetween(0, 59),
            0
        );

        // Garantir que a hora final seja pelo menos 1 hora depois da hora inicial
        $horaFinal = (clone $horaInicial)->addHour();

        return [
            'data_inicial' => $dataInicio->toDateString(),
            'data_final' => $dataFim->toDateString(),
            'hora_inicial' => $horaInicial->toTimeString(),
            'hora_final' => $horaFinal->toTimeString(),
        ];
    }
}
