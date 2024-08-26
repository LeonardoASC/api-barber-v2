<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    // {
    //     "registration_ids": ["er_iozWLQG6c--mEcupImg:APA91bEI5-vBxnMSFf9uCoE-gzqWvaghQ3qus3DF3jPbf6gpV4wPvDxHau5GRUPrM8d2WfOLtmJP8B4wACOZgmYVg-4g6CZATWRgT7mW-Avr3Wx77hqXeO-SMcbk6MJrvkZ4W0kFqdYy"],
    //     "notification": {
    //       "body": "Send me new body",
    //       "title": "Hello, this is new",
    //       "name": "hello",
    //       "da": "this is console data",
    //       "clickUrl": "https://google.com"
    //     }
    //   }
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $this->sendNotifications();
        })->everyMinute();
    }

    protected function sendNotifications()
    {
        // Pega os agendamentos que estão a 30 minutos de acontecer
        $start = now();
        $end = now()->addMinutes(30);

        $appointments = DB::table('agendamentos')
            ->whereBetween('horario', [$start, $end])
            ->where('status', 'Agendado')
            ->where('notification_sent', false)
            ->get();

        foreach ($appointments as $appointment) {
            $user = User::find($appointment->user_id);
            if ($user && $user->expo_token) {
                $this->sendExpoNotification($user->expo_token, "Seu agendamento é em 30 minutos!");
                // Marca que a notificação foi enviada para este agendamento
                DB::table('agendamentos')->where('id', $appointment->id)->update(['notification_sent' => true]);
            }
        }
    }

    protected function sendExpoNotification($token, $message)
    {
        $expo = \ExponentPhpSDK\Expo::normalSetup();

        $notification = ['body' => $message];
        $expo->notify([$token], $notification);
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
