<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function activate(User $user, $token){
    	if($user->activation_token == $token){
    		$user->email_verified_at = date();
    		$user->save();

    		return redirect()->route();
    	}
    }
}
