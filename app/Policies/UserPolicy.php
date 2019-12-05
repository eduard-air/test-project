<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class UserPolicy
{
    use HandlesAuthorization;
    

    public function notActivatedShow()
    {
        return Auth::user()->activation_token;
    }

    public function activate(User $user)
    {
        return Auth::user() == $user;
    }

    public function setPassword()
    {
        return !Auth::user()->activation_token && Auth::user()->temp_password;
    }

    public function profile()
    {
        return !Auth::user()->activation_token && !Auth::user()->temp_password;
    }
}
