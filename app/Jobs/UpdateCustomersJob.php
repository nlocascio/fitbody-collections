<?php

namespace App\Jobs;

use App\Events\UpdatedCustomers;
use App\Jobs\Job;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Event;

class UpdateCustomersJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Async Job
        $this->dispatch(
            new GetClientsFromMindbodyJob()
        );

        //Async Job
        $this->dispatch(
            new GetClientBalancesFromMindbodyJob()
        );

        Event::fire(new UpdatedCustomers());
    }
}
