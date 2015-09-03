<?php

namespace App\Listeners;

use App\Events\UpdatedCustomers;
use App\Events\UpdatingCustomers;
use App\Jobs\GetClientBalancesFromMindbodyJob;
use App\Jobs\GetClientsFromMindbodyJob;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateCustomers implements ShouldQueue
{
    use DispatchesJobs;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdatingCustomers  $event
     * @return void
     */
    public function handle(UpdatingCustomers $event)
    {
        $this->dispatch(
            new GetClientsFromMindbodyJob()
        );

        $this->dispatch(
            new GetClientBalancesFromMindbodyJob()
        );

        event(new UpdatedCustomers());
    }
}
