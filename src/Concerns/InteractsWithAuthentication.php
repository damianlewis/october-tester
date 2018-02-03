<?php

namespace DamianLewis\OctoberTesting\Concerns;

use BackendAuth;
use DamianLewis\OctoberTesting\Browser;
use October\Rain\Auth\Models\User;


trait InteractsWithAuthentication
{
    /**
     * Log into the application as the default user.
     *
     * @return $this
     */
    public function login()
    {
        return $this->loginAs(call_user_func(Browser::$userResolver));
    }

    /**
     * Log into the application using a given user ID or email.
     *
     * @param  object|string $user
     *
     * @return $this
     */
    public function loginAs($user)
    {
        $user = is_a($user, User::class) ? $user : $this->getUserByLogin($user);

        BackendAuth::login($user);

        return $this;
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

    /**
     * Finds a user by the login username.
     *
     * @param string $username
     *
     * @return \October\Rain\Auth\Models\User|null
     */
    protected function getUserByLogin($username)
    {
        return BackendAuth::findUserByLogin($username);
    }

}
