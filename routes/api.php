<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//

Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout']);
Route::get('user', [App\Http\Controllers\AuthController::class, 'getAuthUser']);

Route::apiResource('agendamento', App\Http\Controllers\AgendamentoController::class);
Route::get('/total', [App\Http\Controllers\AgendamentoController::class, 'totalAgendamentos'])->name('totalAgendamentos');
Route::get('/receita-total', [App\Http\Controllers\AgendamentoController::class, 'receitaTotal'])->name('receitaTotal');
Route::get('/ultimo-cliente', [App\Http\Controllers\AgendamentoController::class, 'ultimoClienteQueMarcou'])->name('ultimoClienteQueMarcou');
Route::get('/receita-mensal', [App\Http\Controllers\AgendamentoController::class, 'receitaMensal'])->name('receitaMensal');
Route::get('/receita-semanal', [App\Http\Controllers\AgendamentoController::class, 'receitaSemanal'])->name('receitaSemanal');
Route::get('/receita-diaria', [App\Http\Controllers\AgendamentoController::class, 'receitaDiaria'])->name('receitaDiaria');
Route::get('/servico-mais-selecionado', [App\Http\Controllers\AgendamentoController::class, 'tipoServicoMaisSelecionado'])->name('tipoServicoMaisSelecionado');

Route::get('/agendamentos-dia', [App\Http\Controllers\AgendamentoController::class, 'getAgendamentosDia'])->name('agendamentosDia');
Route::get('/agendamentos-semana', [App\Http\Controllers\AgendamentoController::class, 'getAgendamentosSemana'])->name('agendamentosSemana');
Route::get('/agendamentos-mes', [App\Http\Controllers\AgendamentoController::class, 'getAgendamentosMes'])->name('agendamentosMes');

Route::apiResource('dia', App\Http\Controllers\DiaController::class);

Route::apiResource('horario', App\Http\Controllers\HorarioController::class);
Route::apiResource('horario-personalizado', App\Http\Controllers\HorarioPersonalizadoController::class);

Route::apiResource('servico', App\Http\Controllers\ServicoController::class);
Route::apiResource('subservico', App\Http\Controllers\SubServicoController::class);

Route::get('/verify', [App\Http\Controllers\AgendamentoController::class, 'verificarAgendamento'])->name('agendamento.verificarAgendamento');

Route::get('/verify-hour/{selectedDate}', [App\Http\Controllers\AgendamentoController::class, 'verifyHour'])->name('agendamento.verificarhora');
Route::get('/meus-agendamentos/{user_id}', [App\Http\Controllers\AgendamentoController::class, 'meusAgendamentos'])->name('agendamento.meusAgendamentos');


Route::post('/update-expo-token', [App\Http\Controllers\NotificationController::class, 'updateExpoToken'])->name('updateExpoToken');
Route::post('/remove-expo-token', [App\Http\Controllers\NotificationController::class, 'removeExpoToken'])->name('removeExpoToken');

// Route::post('/test-notifications', [App\Http\Controllers\NotificationController::class, 'sendNotifications'])->name('NotificationController.sendNotifications');

Route::get('/send-notification', [App\Http\Controllers\SendNotificationController::class, 'sendNotification'])->name('SendNotificationController.sendNotifications');
Route::get('/send-test-notification', [App\Http\Controllers\SendNotificationController::class, 'sendTestNotification']);

Route::apiResource('plano', App\Http\Controllers\PlanoController::class);

