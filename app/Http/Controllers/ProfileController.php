<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function notActivatedShow()
    {
        $this->authorize('not-activated-show');

    	return view('profiles.not_activated');
    }


    public function activate(User $user, $token)
    {
        $this->authorize('activate');

    	if($user->activation_token == $token)
    	{
    		$user->email_verified_at = now();
    		$user->activation_token = null;
    		$user->save();

    		return redirect()->route('profile.set_password');
    	}

    	else return redirect()->route('main');
    }


    public function setPasswordShow()
    {
        $this->authorize('set-password');

    	return view('profiles.set_password');
    }


    public function setPassword()
    {
        $this->authorize('set-password');

    	$user = Auth::user();

    	if(request('temp_password') != $user->temp_password){
    		return back()->withErrors(['Temp password is invalid.']);
    	}
    	request()->validate([
    		'password' => 'required|min:6',
    	]);

    	$user->temp_password = null;
    	$user->password = Hash::make(request('password'));
    	$user->save();

    	return redirect()->route('profile.index');
    }


    public function index()
    {
        $this->authorize('profile');

    	return view('profiles.index');
    }
}
