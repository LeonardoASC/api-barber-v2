<?php

namespace App\Http\Controllers;

use App\Models\Dia;
use App\Http\Requests\StoreDiaRequest;
use App\Http\Requests\UpdateDiaRequest;
use Illuminate\Http\Request;

class DiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Dia::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Dia::create($request->all());
        return response()->json([
            "success" => true,
            "data" => $data,
            "msg" => "sucesso"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dia $dia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dia $dia)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'codigo_dia' => 'nullable|string|max:255',
            'dia' => 'nullable|string|max:255',
            'status' => 'required|string|in:ativo,inativo'
        ]);

        // Encontra o dia pelo ID
        $dia = Dia::find($id);

        // Verifica se o registro existe
        if (!$dia) {
            return response()->json(['message' => 'Dia não encontrado'], 404);
        }

        // Atualiza os dados do dia
        $dia->codigo_dia = $request->input('codigo_dia');
        $dia->dia = $request->input('dia');
        $dia->status = $request->input('status');
        $dia->save();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Dia atualizado com sucesso', 'dia' => $dia], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dia $dia)
    {
        //
    }
}
