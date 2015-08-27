<?php

namespace App\Jobs;

use App\Customer;
use App\Jobs\Job;
use App\Services\MindBodyService;
use Illuminate\Contracts\Bus\SelfHandling;

class GetClientsFromMindbodyJob extends Job implements SelfHandling {

    protected $mindBodyApi;

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
     * @param MindBodyService $mindBodyApi
     */
    public function handle(MindBodyService $mindBodyApi)
    {
        $this->mindBodyApi = $mindBodyApi;

        $clients = $this->getClients();

        $this->deactivateMissingClients($clients);

        $this->storeClients($clients);

        return;


    }

    /**
     * @return mixed
     * @throws \ErrorException
     * @internal param MindBodyService $mindBodyApi
     */
    public function getClients()
    {
        $request = [
            'SearchText'       => '',
            'PageSize'         => 1000,
            'CurrentPageIndex' => 0,
            'XMLDetail'        => 'Bare',
            'Fields'           => [
                'Clients.FirstName',
                'Clients.LastName',
                'Clients.Email',
                'Clients.AddressLine1',
                'Clients.AddressLine2',
                'Clients.City',
                'Clients.State',
                'Clients.PostalCode',
                'Clients.MobilePhone',
                'Clients.HomePhone',
                'Clients.PhotoURL',
            ]];

        $getClientsData = $this->mindBodyApi
            ->sendUserCredentials()
            ->GetClients($request)
            ->GetClientsResult;

        if ($getClientsData->ErrorCode != 200 || ! isset($getClientsData->Clients->Client))
        {
            abort(500, 'MindBody API Call failed.');
        }

        return $getClientsData->Clients->Client;
    }

    /**
     * @param $clients
     */
    protected function deactivateMissingClients($clients)
    {
        $currentClientIDs = Customer::all()->lists('id')->toArray();
        $newClientIDs = array_pluck($clients, 'ID');

        $inactiveClientIDs = array_diff($currentClientIDs, $newClientIDs);

        Customer::whereIn('id', $inactiveClientIDs)
            ->update(['active' => 0]);
    }

    /**
     * @param $clients
     */
    public function storeClients($clients)
    {
        foreach ($clients as $d)
        {
            Customer::updateOrCreate(['mindbody_id' => $d->ID],
                [
                    'mindbody_id'    => $d->ID,
                    'active'         => 1,
                    'first_name'     => $d->FirstName,
                    'last_name'      => $d->LastName,
                    'email'          => isset($d->Email) ? $d->Email : null,
                    'address_line_1' => isset($d->AddressLine1) ? $d->AddressLine1 : null,
                    'address_line_2' => isset($d->AddressLine2) ? $d->AddressLine2 : null,
                    'city'           => isset($d->City) ? $d->City : null,
                    'state'          => isset($d->State) ? $d->State : null,
                    'postal_code'    => isset($d->PostalCode) ? $d->PostalCode : null,
                    'mobile_phone'   => isset($d->MobilePhone) ? $d->MobilePhone : null,
                    'home_phone'     => isset($d->HomePhone) ? $d->HomePhone : null,
                    'photo_url'      => isset($d->PhotoURL) ? $d->PhotoURL : null,
                ]);
        }
    }
}
