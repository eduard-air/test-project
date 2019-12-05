<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MainPageController extends Controller
{
    public function index()
    {
    	if(Auth::check())
    	{
			if(Auth::user()->activation_token) return redirect()->route('profile.not_activated');
			else if(Auth::user()->temp_password) return redirect()->route('profile.set_password');
			else return redirect()->route('profile.index');
		}

		else return view('welcome');
    }
}
