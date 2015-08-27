<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Jobs\GetClientBalancesFromMindbodyJob;
use App\Jobs\GetClientsFromMindbodyJob;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CustomerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $customers = Customer::where('account_balance', '<', 0)->get();

        return view('pages.customer_index', ['customers' => $customers]);
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
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('pages.customer_show',['customer' => $customer]);
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
        $this->dispatch(
            new GetClientsFromMindbodyJob()
        );

        $this->dispatch(
            new GetClientBalancesFromMindbodyJob()
        );

        return redirect()->back();
    }
}
