<?php

use App\Customer;
use Illuminate\Database\Seeder;

class LetterTableSeeder extends Seeder
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
            $customer->letters()->saveMany(factory(App\Letter::class, 23)->make());
        });
    }
}
