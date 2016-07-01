<?php

namespace App\Providers;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Log;
use Nlocascio\Mindbody\Facades\Mindbody;

class MindbodyUserProvider implements UserProvider {

    public $model;
    protected $mindbodyApi;

    public function __construct(Authenticatable $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
        $user = User::where('id', $identifier)->first();

        return $user;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed $identifier
     * @param  string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        return User::where('id', $identifier)->where('remember_token', $token)->first();
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  string $token
     * @return void
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        if ($user != null)
        {
            $user->setRememberToken($token);
            $user->save();
        }
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        $user = null;

        $user = User::firstOrNew(['username' => $credentials['username']]);

        return $user;
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  array $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {

        if ( ! $user->username == $credentials['username'])
        {
            return false;
        }

        $getStaffResult = Mindbody::GetStaff([
            'StaffCredentials' => [
                'SiteIDs' => [27796],
                'Username' => $credentials['username'],
                'Password' => $credentials['password'],
            ]
        ])->GetStaffResult;


        if ( ! isset ($getStaffResult->ErrorCode) || $getStaffResult->ErrorCode != 200)
        {
            return false;
        }

        $user->fill([
            'name' => isset($getStaffResult->StaffMembers->Staff->FirstName) ? $getStaffResult->StaffMembers->Staff->FirstName : null
        ]);

        return $user->save();

    }
}
