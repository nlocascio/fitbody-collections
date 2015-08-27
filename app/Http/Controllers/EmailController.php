<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Email;
use App\Jobs\SendCustomerEmail;
use App\Jobs\SendCustomerEmailJob;
use App\Template;
use Flynsarmy\DbBladeCompiler\Facades\DbView;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Carbon\Carbon;

class EmailController extends Controller {

    private $formLetters;

    public function __construct(Template $template)
    {
        $this->formLetters = $template->lists('name', 'id')->toArray();
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($customerId)
    {
        $emails = ($customerId == '*') ? Email::with('customer')->get() : Email::where('customer_id', $customerId)->get();

        return view('pages.email_index', ['emails' => $emails, 'customerId' => $customerId]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($customerId)
    {
        $customers = Customer::where('account_balance', '<', 0)->get();

        $selectedCustomerIds = explode('+', $customerId);

        foreach ($customers as $customer)
        {
            $customerData[$customer->id] = "$customer->last_name, $customer->first_name ($$customer->account_balance)";
        }

        return view('pages.email_create', ['customers' => $customerData, 'selectedCustomerIds' => $selectedCustomerIds, 'form_letters' => $this->formLetters]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request, $customerId)
    {
        $customers = Customer::whereIn('id', explode('+', $customerId))->get();
        $template = Template::findOrFail($request->form_letter_id);

        if ($request->has('confirmed'))
        {
            foreach ($customers as $customer)
            {
                $this->dispatch( new SendCustomerEmailJob($template, $customer));
            }

            return redirect()->back()->with('flash', 'Success!');
        }

        return redirect()->back()->with([
            'askForConfirmation' => [
                'message'    => "Are you SURE you want to send?<p>$template->title",
                'data'       => [
                    'form_letter_id' => $request->form_letter_id,
                    'customer_id'    => json_encode($request->customer_id)
                ],
                'method'     => 'post',
                'submitName' => 'Send',
                'url'        => $request->path()
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
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


}
