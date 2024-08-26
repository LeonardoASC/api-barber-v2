<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Http\Requests\StoreServicoRequest;
use App\Http\Requests\UpdateServicoRequest;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Servico::all();
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
        $regras = [
            'name' => 'required|unique:servicos,name',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'hora.unique' => 'Esse tipo de servico já foi registrado.',
        ];
        $request->validate($regras, $feedback);


        $data = Servico::create($request->all());
        return response()->json([
            "success" => true,
            "data" => $data,
            "msg" => "sucesso"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        $regras = [
            'name' => 'required',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
        ];
        $request->validate($regras, $feedback);

        $servico->update($request->all());
        return response()->json([
            "success" => true,
            "data" => $servico,
            "msg" => "sucesso"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        try {
            // Tentativa de deletar o servico
            $servico->delete();

            return response()->json(['message' => 'servico deleted successfully'], Response::HTTP_OK);

        } catch (QueryException $e) {
            // Caso haja algum erro na operação do banco de dados
            return response()->json(['message' => 'Failed to delete the servico'], Response::HTTP_INTERNAL_SERVER_ERROR);

        } catch (\Exception $e) {
            // Caso haja algum outro erro não esperado
            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
