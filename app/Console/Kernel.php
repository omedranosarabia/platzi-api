<?php

namespace App\Console;

use App\Console\Commands\SendEmailVerificationReminderCommand;
use App\Console\Commands\SendNewsletterCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendNewsletterCommand::class,
        SendEmailVerificationReminderCommand::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
        ->everyMinute()
        ->evenInMaintenanceMode()
        ->sendOutputTo(storage_path('inspire.log'))
        ;


        $schedule->call(function () {
            echo "Hola";
        })->everyFifteenMinutes();

        $schedule->command(SendNewsletterCommand::class)
        ->withoutOverlapping()
        ->mondays()
        ->onOneServer()
        ;

        $schedule->command(SendEmailVerificationReminderCommand::class)
        ->daily()
        ->onOneServer()
        ;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
