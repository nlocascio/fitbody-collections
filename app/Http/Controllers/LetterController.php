<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Letter;
use App\Template;
use Carbon\Carbon;
use Clegginabox\PDFMerger\PDFMerger;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use PDF;
use DbView;
use DB;
use Response;

class LetterController extends Controller {

    /**
     * @var array
     */
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
    public function index()
    {
        $letters = Letter::with('customer')->get();

        return view('pages.letter_index', ['letters' => $letters]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $customerId
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

        return view('pages.letter_create', ['customers' => $customerData, 'selectedCustomerIds' => $selectedCustomerIds, 'form_letters' => $this->formLetters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $customers = Customer::whereIn('id', $request->customer_id)->get();

        $template = Template::findOrFail($request->form_letter_id);

        $date = Carbon::now();

        foreach ($customers as $k => $customer)
        {
            DB::beginTransaction();

            $letters[$k] = $customer->letters()->create([
                'description' => $this->formLetters[$request->form_letter_id],
                'amount'      => $customer->account_balance
            ]);

            $filePath = storage_path() . "/app/letters/" . $letters[$k]->id . "-$customer->last_name-$customer->first_name-" . $date->toDateString() . ".pdf";

            $letters[$k]->file_path = $filePath;

            $customer->letters()->save($letters[$k]);

            $letterData = DbView::make($template, ['date' => $date->toFormattedDateString(), 'customer' => $customer])->render();

            $letterData = preg_replace('/[[:^print:]]/', '', $letterData);

            $pdf = PDF::loadHTML($letterData);
            $pdf->save($filePath);

            DB::commit();
        }

        if ($request->has('saveAndDownload'))
        {
            return redirect()
                ->route('customer.letter.index', ['customer' => '*'])
                ->with('download_on_next_page', route('customer.letter.show', ['customer' => '*', 'letter' => implode('+', array_pluck($letters, 'id'))]));
        }

        return redirect()->route('customer.letter.index', ['customer' => '*']);
    }

    /**
     * Display the specified resource.
     *
     * @param $customerId
     * @param $letterId
     * @throws \Exception
     * @internal param int $id
     */
    public function show($customerId, $letterId)
    {
        $letters = Letter::whereIn('id', explode('+', $letterId))->with('customer')->get();

        $pdf = new PDFMerger();

        foreach ($letters as $letter)
        {
            $pdf->addPDF($letter->file_path);
        }

        $headers = [
            'Cache-Control'         => 'must-revalidate, post-check=0, pre-check=0'
            , 'Content-type'        => 'application/pdf'
            , 'Content-Disposition' => 'attachment; filename=download.pdf'
            , 'Expires'             => '0'
            , 'Pragma'              => 'public'
        ];

        return response($pdf->merge('string', 'print.pdf'))
            ->header('Content-type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename=download.pdf')
            ;
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
     * @param $customerId
     * @param $letterId
     * @return Response
     * @internal param int $id
     */
    public function destroy($customerId, $letterId, Request $request)
    {
        $letters = Letter::whereIn('id', explode('+', $letterId))->with('customer')->get();

        if ($request->has('confirmed'))
        {
            foreach ($letters as $letter)
            {
                try
                {
                    rename($letter->file_path, $letter->file_path . 'DELETED');
                } catch (\ErrorException $e)
                {

                }
                $letter->delete();
            }

            return redirect()->back();
        }

        $message = "Are you SURE you want to delete these letters? This cannot be undone." . PHP_EOL;
        foreach ($letters as $letter)
        {
            $message .= "$letter->id:" . $letter->customer->first_name . ' ' . $letter->customer->last_name . PHP_EOL;
        }

        return redirect()->back()->with([
            'askForConfirmation' => [
                'message'    => $message,
                'method'     => 'delete',
                'submitName' => 'Yes, Delete',
                'url'        => $request->path()
            ]
        ]);

    }
}
