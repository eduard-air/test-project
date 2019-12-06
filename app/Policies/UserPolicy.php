<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class UserPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine if the user can see "not activated" page.
     *
     * @return bool
     */
    public function notActivatedShow()
    {
        return Auth::user()->activation_token;
    }

    /**
     * Determine if the user can activate profile.
     *
     * @return bool
     */
    public function activate(User $user)
    {
        return Auth::user() == $user;
    }

    /**
     * Determine if the user can set password.
     *
     * @return bool
     */
    public function setPassword()
    {
        return !Auth::user()->activation_token && Auth::user()->temp_password;
    }

    /**
     * Determine if the user can see his profile page.
     *
     * @return bool
     */
    public function profile()
    {
        return !Auth::user()->activation_token && !Auth::user()->temp_password;
    }
}
