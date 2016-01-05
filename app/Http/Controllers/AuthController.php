<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect;
use Input;
use Auth;

class AuthController extends Controller{
    
    public function index(){ 
    	return Redirect::to('/login');
    }

    public function getLogin(){
    	return view('login');
    }

    public function postLogin(){
    	$userData = array(
    		"username" => Input::get('username'),
    		"password" => Input::get('password')
    	);

    	if(Auth::attempt($userData)){
    		return Redirect::to('/admin');
    	}else{
    		echo 'no';
    	}
    }

}
