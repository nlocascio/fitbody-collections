<?php

namespace App\Console\Commands;

use App\Jobs\GetClientBalancesFromMindbodyJob;
use App\Jobs\GetClientsFromMindbodyJob;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;

class NightlySyncCommand extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collections:nightly-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Running FitBody Collections nightly sync command...');

        $this->dispatch(new GetClientsFromMindbodyJob);

        $this->dispatch(new GetClientBalancesFromMindbodyJob);

        $this->info('Done.');
    }
}
