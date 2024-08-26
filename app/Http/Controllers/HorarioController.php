<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Http\Requests\StoreHorarioRequest;
use App\Http\Requests\UpdateHorarioRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Horario::all();
        return Horario::orderBy('hora', 'asc')->get();
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
            'hora' => 'required|date_format:H:i|unique:horarios,hora',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'hora.date_format' => 'O campo hora deve estar no formato HH:mm',
            'hora.unique' => 'Esta hora já foi registrada.',
        ];
        $request->validate($regras, $feedback);


        $data = Horario::create($request->all());
        return response()->json([
            "success" => true,
            "data" => $data,
            "msg" => "sucesso"
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {

        $regras = [
            'hora' => 'required|date_format:H:i',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'hora.date_format' => 'O campo hora deve estar no formato HH:mm',
            'hora.unique' => 'Esta hora já foi registrada.',
        ];
        $request->validate($regras, $feedback);

        $horario->update($request->all());
        return response()->json([
            "success" => true,
            "data" => $horario,
            "msg" => "sucesso"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Horario $horario)
    {
        try {
            $horario->delete();
            return response()->json(['message' => 'Horario deleted successfully'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Failed to delete the Horario'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Server error'], 500);
        }
    }
}
