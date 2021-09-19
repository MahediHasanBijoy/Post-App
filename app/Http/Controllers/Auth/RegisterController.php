<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
    	return view('auth.register');
    }

    public function store(Request $request)
    {
    	//validation
    	//store user

    	//redirect
    	$this->validate($request, [
    		'name'=>'required|max:255',
    		'email'=>'required|email|max:255',
    		'password'=>'required|confirmed',
    	]);

    	User::create([
    		'name'=>$request->name,
    		'email'=>$request->email,
    		'password'=>Hash::make($request->password),
    	]);

    	//sign the user in
    	auth()->attempt($request->only('email','password'));
    	return redirect()->route('dashboard');


    }
}
