<?php

namespace App\Http\Controllers;

use App\Models\HorarioPersonalizado;
use App\Http\Requests\StoreHorarioPersonalizadoRequest;
use App\Http\Requests\UpdateHorarioPersonalizadoRequest;
use Illuminate\Http\Request;

class HorarioPersonalizadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HorarioPersonalizado::orderBy('data_inicial', 'desc')->get(); 
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
    public function store(StoreHorarioPersonalizadoRequest $request)
    {
       
        $data = HorarioPersonalizado::create($request->all());
        return response()->json([
            "success" => true,
            "data" => $data,
            "msg" => "sucesso"
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(HorarioPersonalizado $horarioPersonalizado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HorarioPersonalizado $horarioPersonalizado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHorarioPersonalizadoRequest $request, HorarioPersonalizado $horarioPersonalizado)
    {
        $horarioPersonalizado->update($request->all());
        return response()->json([
            "success" => true,
            "data" => $horarioPersonalizado,
            "msg" => "sucesso"
        ], 200); 
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HorarioPersonalizado $horarioPersonalizado)
    {
        $horarioPersonalizado->delete();
        return response()->json([
            "success" => true,
            "msg" => "sucesso"
        ], 200);

    }
}
