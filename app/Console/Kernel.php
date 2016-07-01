<?php

namespace App\Console;

use App\Jobs\GetClientBalancesFromMindbodyJob;
use App\Jobs\GetClientsFromMindbodyJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    use DispatchesJobs;

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule
            ->call(function () {
                $this->dispatch(new GetClientsFromMindbodyJob);
            })
            ->dailyAt('07:00')// 3:00 am local
            ->then(function () {
                $this->dispatch(new GetClientBalancesFromMindbodyJob);
            })
            ->sendOutputTo(storage_path('app/taskoutput.txt'))
            ->emailOutputTo('nlocascio@gmail.com');
    }
}
