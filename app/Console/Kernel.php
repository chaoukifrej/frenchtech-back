<?php

namespace App\Console;

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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            $total_actors = Actor::where('category', 'like', 'startUp')->get()->count();
            $total_funds = (int) Actor::sum('funds');
            $total_jobs_available = (int) Actor::sum('jobs_available_number');
            $total_women_number = (int) Actor::sum('women_number');
            $total_revenues = (int) Actor::sum('revenues');

            Historic::create([
                'total_actors' => $total_actors,
                'total_funds' => $total_funds,
                'total_jobs_available' => $total_jobs_available,
                'total_women_number' => $total_women_number,
                'total_revenues' => $total_revenues,
            ]);
        })->daily();
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
