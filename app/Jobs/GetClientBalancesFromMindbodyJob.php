<?php

namespace App\Jobs;

use App\Customer;
use App\Jobs\Job;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Log;
use Nlocascio\Mindbody\Facades\Mindbody;
use Nlocascio\Mindbody\Services\MindbodyService;

class GetClientBalancesFromMindbodyJob extends Job implements SelfHandling {

    protected $mindbodyApi;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return string
     */
    public function handle()
    {
        Log::info('Retrieving MINDBODY Client Balances...');

        $customers = Customer::where('active', '=', 1);

        $clientsWithBalances = $this->getClientsWithBalances($customers->lists('mindbody_id')->toArray());

        $this->updateClientBalances($clientsWithBalances);

        Log::info('Successfully retrieved ' & count($clientsWithBalances) & ' MINDBODY Client Balances.');
    }

    /**
     * @param $clientIds
     * @return array
     */
    public function getClientsWithBalances($clientIds)
    {
        $allClients = $this->getClients($clientIds);

        return (array_filter($allClients, function ($value)
        {
            return $value->AccountBalance < 0;
        }));
    }

    /**
     * @param $clientIds
     * @return mixed
     */
    public function getClients($clientIds)
    {
        $request = [
            'ClientIDs'        => $clientIds,
            'PageSize'         => 1000,
            'CurrentPageIndex' => 0,
            'XMLDetail'        => 'Bare',
            'BalanceDate'      => Carbon::now()->addDay()->toDateString(),
            'Fields'           => [
                'Clients.ID',
                'Clients.AccountBalance',
            ]];

        $response = Mindbody::GetClientAccountBalances($request)->GetClientAccountBalancesResult;

        if ($response->ErrorCode != 200 || ! isset($response->Clients->Client))
        {
            abort(500, 'MindBody API Call failed.');
        }

        return $response->Clients->Client;
    }

    /**
     * @param $clients
     * @return bool
     */
    public function updateClientBalances($clients)
    {
        $this->clearAllClientBalances();

        foreach ($clients as $d)
        {
            Customer::updateOrCreate(['mindbody_id' => $d->ID],
                [
                    'account_balance' => $d->AccountBalance
                ]);
        }
    }

    protected function clearAllClientBalances()
    {
        Customer::whereNotNull('id')->update(['account_balance' => null]);
    }
}
