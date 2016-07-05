<?php

namespace App\Jobs;

use App\Customer;
use App\Jobs\Job;
use App\Template;
use App\Email;
use Carbon\Carbon;
use Flynsarmy\DbBladeCompiler\Facades\DbView;
use Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCustomerEmailJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /**
     * @var Template
     */
    private $template;
    /**
     * @var Customer
     */
    private $customer;

    /**
     * Create a new job instance.
     *
     * @param Template $template
     * @param Customer $customer
     */
    public function __construct(Template $template, Customer $customer)
    {
        //
        $this->template = $template;
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $date = Carbon::now();
        $template = $this->template;
        $customer = $this->customer;

        $emailView = DbView::make($template)->with(['date' => $date->toFormattedDateString(), 'customer' => $customer])->render();

        Mail::send('emails.dbview', ['emailView' => $emailView], function ($message) use ($template, $customer)
        {
            $message
                ->from('nlocascio@getmyfitbody.com', 'Nick LoCascio')
                ->to($customer->email, "$customer->first_name $customer->last_name")
                ->subject($template->title)
            ;
        });

        $email = new Email([
            'subject' => $template->title,
            'content' => $emailView
        ]);

        $customer->emails()->save($email);
    }
}
