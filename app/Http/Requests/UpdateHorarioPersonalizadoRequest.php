<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateHorarioPersonalizadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data_inicial' => [
                'required',
                'date',
                // Rule::unique('horario_personalizados', 'data_inicial')->ignore($this->horarioPersonalizado),
            ],
            'data_final' => [
                'required',
                'date',
                'after:data_inicial',
                // Rule::unique('horario_personalizados', 'data_final')->ignore($this->horarioPersonalizado),
            ],
            'hora_inicial' => 'required|date_format:H:i',
            'hora_final' => 'required|date_format:H:i|after:hora_inicial',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'data_inicial.unique' => 'A data de início já existe.',
            'data_final.unique' => 'A data final já existe.',
            'data_final.after' => 'A data final deve ser posterior à data inicial.',
            'hora_final.after' => 'A hora final deve ser posterior à hora inicial.',
        ];
    }
}
