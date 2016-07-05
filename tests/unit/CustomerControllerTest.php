<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerControllerTest extends AppTester
{

    /** @test */
    public function it_fetches_the_customers_page()
    {
        $this->actingAs($this->makeUser());

        $this->visit('/customers');

        $this->seeInElement('.dashhead-title', 'Customers');

    }
}
