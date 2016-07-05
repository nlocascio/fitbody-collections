<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Nlocascio\Mindbody\Facades\Mindbody;
use Mockery as m;

class LoginControllerTest extends AppTester
{
    use DatabaseMigrations;


    /** @test */
    public function it_fetches_the_login_page()
    {
        $this
            ->get('/auth/login');

        $this
            ->see('Username')
            ->see('Password')
            ->see('Remember me')
            ->see('Log In');
    }

    /** @test */
    public function it_logs_in_a_user()
    {
        $this->makeUser();

        Mindbody::shouldReceive('GetStaff')
            ->once()
            ->andReturn(json_decode(json_encode(
                ['GetStaffResult' => [
                    'ErrorCode' => 200
                ]]
            )))
        ;

        $this->visit('/auth/login')
             ->type('temp', 'username')
             ->type('Temp1234', 'password')
             ->press('Log In')
             ->seePageIs('/dashboard');

        $this->assertResponseOk();

    }

    /** @test */
    public function it_fails_a_login_when_the_password_is_wrong()
    {
        Mindbody::shouldReceive('GetStaff')
                ->once()
                ->andReturn(json_decode(json_encode(
                    ['GetStaffResult' => [
                        'ErrorCode' => 401
                    ]]
                )))
        ;

        $this
            ->visit('/auth/login')
            ->type('temp', 'username')
            ->type('Temp1234', 'password')
            ->press('Log In');

        $this
            ->seePageIs('/auth/login')
            ->assertResponseOk();
    }

    /** @test */
    public function it_logs_out_a_user()
    {
        $this->makeUser();
        $this->actingAs(User::find(1));

        $this->visit('/auth/logout')
            ->seePageIs('/');

        $this->visit('/dashboard')
            ->seePageIs('/auth/login');
    }

}
