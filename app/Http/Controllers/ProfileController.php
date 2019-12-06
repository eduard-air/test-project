<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    /**
     * Show page for not activated user.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function notActivatedShow()
    {
        $this->authorize('not-activated-show');

    	return view('profiles.not_activated');
    }

    /**
     * Profile activation.
     *
     * @param User $user
     * @param $token
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function activate(User $user, $token)
    {
        $this->authorize('activate');

    	if($user->activation_token == $token){
            
    		$user->email_verified_at = now();
    		$user->activation_token = null;
    		$user->save();

    		return redirect()->route('profile.set_password');
    	}

    	else return redirect()->route('main');
    }

    /**
     * Show password change page.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function setPasswordShow()
    {
        $this->authorize('set-password');

    	return view('profiles.set_password');
    }

    /**
     * Password change.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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

    /**
     * Show profile page.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('profile');

    	return view('profiles.index');
    }
}
