<?php

namespace DamianLewis\OctoberTesting\Concerns;

use BackendAuth;
use DamianLewis\OctoberTesting\Browser;
use October\Rain\Auth\AuthException;
use October\Rain\Auth\Models\User;

trait InteractsWithAuthentication
{
    /**
     * Log into the application with the default user credentials.
     *
     * @return $this
     */
    public function login()
    {
        return $this->loginWith(call_user_func(Browser::$userCredentialsResolver));
    }

    /**
     * Log into the application with the user credentials.
     *
     * @param  array $userCredentials Array containing the user login and password to authenticate.
     *
     * @return $this
     */
    public function loginWith($userCredentials)
    {
        if (!is_array($userCredentials)) {
            throw new AuthException('An array containing the login and password for a user is required.');
        }

        return $this->visit('/backend')
            ->type('login', $userCredentials['login'])
            ->type('password', $userCredentials['password'])
            ->press('Login');
    }

    /**
     * Log out of the application.
     *
     * @return $this
     */
    public function logout()
    {
        return $this->visit('/backend/auth/signout');
    }

}
