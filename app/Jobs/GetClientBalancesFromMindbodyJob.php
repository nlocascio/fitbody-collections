<?php

namespace App\Jobs;

use App\Customer;
use App\Jobs\Job;
use App\Services\MindBodyService;
use Illuminate\Contracts\Bus\SelfHandling;

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
     * @param MindBodyService $mindbodyApi
     */
    public function handle(MindBodyService $mindbodyApi)
    {
        $this->mindbodyApi = $mindbodyApi;

        $customers = Customer::where('active', '=', 1);

        $clientsWithBalances = $this->getClientsWithBalances($customers->lists('mindbody_id')->toArray());

        $customers->update(['account_balance' => null]);

        $this->updateClientBalances($clientsWithBalances);
    }

    /**
     * @param $clientIds
     * @return array
     */
    public function getClientsWithBalances($clientIds)
    {
        $allClients = $this->getClients($clientIds);

        return(array_filter($allClients, function ($value)
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
            'Fields'           => [
                'Clients.ID',
                'Clients.AccountBalance',
            ]];

        $data = $this->mindbodyApi->GetClientAccountBalances($request)->GetClientAccountBalancesResult;

        if ($data->ErrorCode != 200 || ! isset($data->Clients->Client))
        {
            abort(500, 'MindBody API Call failed.');
        }

        return $data->Clients->Client;
    }

    /**
     * @param $clients
     * @return bool
     */
    public function updateClientBalances($clients)
    {
        foreach ($clients as $d)
        {
            Customer::updateOrCreate(['mindbody_id' => $d->ID],
                [
                    'account_balance' => $d->AccountBalance
                ]);
        }
        return true;
    }
}
