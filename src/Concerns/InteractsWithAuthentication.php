<?php

namespace DamianLewis\OctoberTester\Concerns;

use BackendAuth;
use DamianLewis\OctoberTester\Browser;
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
        if (empty($userCredentials['login'])) {
            throw new AuthException('A [login] for a user is required.');
        }

        if (empty($userCredentials['password'])) {
            throw new AuthException('A [password] for a user is required.');
        }

        return $this->visit('/backend')
            ->type('login', $userCredentials['login'])
            ->type('password', $userCredentials['password'])
            ->press('Login');
    }

    /**
     * Log out of the application.
     *
     * @param string $guard
     *
     * @return $this
     */
    public function logout($guard = null)
    {
        return $this->visit('/backend/auth/signout');
    }

}