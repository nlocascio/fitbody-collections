<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Events\UpdateCustomersEvent;
use App\Events\UpdatingCustomers;
use App\Jobs\UpdateCustomersJob;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Queue;

class CustomerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::where('account_balance', '<', 0)->get();

            return response()->json($customers);
        }

        return view('pages.customers');
    }

    /**
     * Show the form for updating all customers.
     *
     * @return Response
     */
    public function create()
    {
        //
//        return view('pages.customer_create');
    }

    /**
     * Update the customer table.
     * 1. get all clients from MindBody.
     * 2. get client balances
     *
     * @return Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show(Customer $customer)
    {
        return view('pages.customer_show',['customer' => $customer, 'letters' => $customer->letters, 'emails' => $customer->emails ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function refresh()
    {
        $this->dispatch(new UpdateCustomersJob);

        return response('OK', 200);
    }
}
