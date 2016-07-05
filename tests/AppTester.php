<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AppTester extends TestCase
{
    use DatabaseMigrations;

    protected function makeUser(array $data = [])
    {
        $user = \App\User::create(array_merge([
            'name'           => 'Temp name',
            'username'       => 'temp',
            'remember_token' => ''
        ], $data));

        return $user;

    }
}