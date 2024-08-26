<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Agendamento;
use App\Models\Horario;
use App\Http\Requests\StoreAgendamentoRequest;
use App\Http\Requests\UpdateAgendamentoRequest;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Agendamento::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = Agendamento::create($request->all());
        return response()->json([
            "success" => true,
            "data" => $data,
            "msg" => "sucesso"
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
{
    return Agendamento::findOrFail($id);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->update($request->all());

        return response()->json(['message' => 'Agendamento atualizado com sucesso!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agendamento = Agendamento::findOrFail($id);
        $agendamento->delete();
    }

    public function verificarAgendamento(Request $request)
    {
        $dia = $request->input('dia');
        $horario = $request->input('horario');

        $exists = Agendamento::where('dia', $dia)
            ->where('horario', $horario)
            ->exists();

        return response()->json(['exists' => $exists]);
    }

    public function verifyHour(Request $request, $selectedDate) {
        // Defina os horários disponíveis durante o dia.
        $availableHours = Horario::pluck('hora')->toArray();

        // Obtenha os horários já reservados no banco de dados para o dia selecionado.
        $reservedHours = Agendamento::where('dia', $selectedDate)->pluck('horario')->toArray();

        // Filtrar os horários disponíveis que não estão reservados.
        $unreservedHours = array_diff($availableHours, $reservedHours);

        // Retorne os horários não reservados.
        return response()->json(['unreservedHours' => $unreservedHours]);
    }

    public function totalAgendamentos()
    {
        return response()->json(['total' => Agendamento::count()]);
    }

    public function receitaTotal()
    {
        $receita = Agendamento::where('status', 'Concluido')->sum('preco');
        return response()->json(['receita_total' => $receita]);
    }

    public function ultimoClienteQueMarcou()
    {
        $agendamento = Agendamento::orderBy('created_at', 'desc')->first();
        return response()->json($agendamento);
    }

    public function receitaMensal()
    {
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        $receita = Agendamento::where('status', 'Concluido')
                    ->whereMonth('dia', $month)
                    ->whereYear('dia', $year)
                    ->sum('preco');

        return response()->json(['receita_mensal' => $receita]);
    }

    public function receitaSemanal()
    {
        $inicioSemana = Carbon::now()->startOfWeek();
        $fimSemana = Carbon::now()->endOfWeek();

        $receita = Agendamento::where('status', 'Concluido')
                    ->whereBetween('dia', [$inicioSemana, $fimSemana])
                    ->sum('preco');

        return response()->json(['receita_semanal' => $receita]);
    }

    public function receitaDiaria()
    {
        $today = Carbon::today();

        $receita = Agendamento::where('status', 'Concluido')
                    ->whereDate('dia', $today)
                    ->sum('preco');

        return response()->json(['receita_diaria' => $receita]);
    }

    public function tipoServicoMaisSelecionado()
    {
        $tipo = Agendamento::select('tipo_servico')
                ->groupBy('tipo_servico')
                ->orderByRaw('COUNT(*) DESC')
                ->first();
        return response()->json($tipo);
    }

    public function getAgendamentosDia()
    {
        $hoje = Carbon::today();
        $quantidade = Agendamento::whereDate('dia', $hoje)->count();

        return response()->json(['quantidade_agendamentos_dia' => $quantidade]);
    }

    public function getAgendamentosSemana()
    {
        $inicioSemana = Carbon::now()->startOfWeek();
        $fimSemana = Carbon::now()->endOfWeek();
        $quantidade = Agendamento::whereBetween('dia', [$inicioSemana, $fimSemana])->count();

        return response()->json(['quantidade_agendamentos_semana' => $quantidade]);
    }

    public function getAgendamentosMes()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $fimMes = Carbon::now()->endOfMonth();
        $quantidade = Agendamento::whereBetween('dia', [$inicioMes, $fimMes])->count();

        return response()->json(['quantidade_agendamentos_mes' => $quantidade]);
    }


    public function meusAgendamentos($user_id){

        $agendamentos = Agendamento::where('user_id', $user_id)
                                   ->orderBy('dia', 'desc')
                                   ->orderBy('horario', 'desc')
                                   ->get();

        return response()->json($agendamentos);
    }

}
