<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;
use App\Http\Requests\StorePlanoRequest;
use App\Http\Requests\UpdatePlanoRequest;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Plano::orderBy('preco', 'asc')->get();
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
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:1',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'string' => 'O campo :attribute deve ser um texto',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'numeric' => 'O campo :attribute deve ser um número',
            'integer' => 'O campo :attribute deve ser um número inteiro',
            'min' => 'O campo :attribute deve ter um valor mínimo de :min',
        ];

        $request->validate($regras, $feedback);


        $data = Plano::create($request->all());
        return response()->json([
            "success" => true,
            "data" => $data,
            "msg" => "sucesso"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plano $plano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plano $plano)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plano $plano)
    {
        $regras = [
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:1',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'string' => 'O campo :attribute deve ser um texto',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres',
            'numeric' => 'O campo :attribute deve ser um número',
            'integer' => 'O campo :attribute deve ser um número inteiro',
            'min' => 'O campo :attribute deve ter um valor mínimo de :min',
        ];

        $request->validate($regras, $feedback);

        $plano->update($request->all());
        return response()->json([
            "success" => true,
            "data" => $plano,
            "msg" => "sucesso"
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plano $plano)
    {
        try {
            $plano->delete();
            return response()->json(['message' => 'plano deleted successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete the plano'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}
