<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class NotificationController extends Controller
{
    public function updateExpoToken(Request $request)
    {
        $request->validate([
            'expo_token' => 'required|string',
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated.'], 401); // código 401 é "Não autorizado"
        }

        $user->expo_token = $request->expo_token;
        $user->save();

        return response()->json(['message' => 'Token updated successfully.']);
    }

    public function removeExpoToken(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated.'], 401); // código 401 é "Não autorizado"
        }
        
        $user->expo_token = null;
        $user->save();

        return response()->json(['message' => 'Token removed successfully.']);
    }

    public function sendNotifications()
    {
        // Pega os agendamentos que estão a 30 minutos de acontecer
        $start = now();
        $end = now()->addMinutes(30);

        $appointments = DB::table('agendamentos')
            ->whereBetween('horario', [$start, $end])
            // ->where('status', 'Agendado')
            ->get();


        // foreach ($appointments as $appointment) {
        //     $user = User::find($appointment->user_id);
        //     if ($user && $user->expo_token) {
        //         $this->sendNotifications($user->expo_token, "Seu agendamento é em 30 minutos!");
        //     }
        // }

        return response()->json($appointments); // Retorna todos os agendamentos no intervalo de 30 minutos
    }


}
