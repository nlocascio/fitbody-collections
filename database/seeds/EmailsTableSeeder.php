<?php

use App\Customer;
use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = Customer::where('account_balance', '<', 0)->get();

        $customers->each(function ($customer, $key) {
            $customer->emails()->saveMany(factory(App\Email::class, 30)->make());
        });
    }
}
