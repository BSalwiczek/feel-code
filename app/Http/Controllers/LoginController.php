<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    public function checkIfAdmin(Request $request)
    {
    	if($request->login=='Admin' && $request->password=='qwerty')
    	{
    		Session::set('Login',true);
    		return redirect('/');
    	}else
    	{
    		return '<span style="color:red">Invalid login or password!</span>';
    	}
    }
    public function getLogin()
    {
    	return view('pages.login');
    }

    public function logout()
    {
    	if(Session::get('Login')==true)
    		Session::set('Login',false);
    	return redirect('/');
    }
}
