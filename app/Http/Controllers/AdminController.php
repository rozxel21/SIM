<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Provider\Uuid;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\updateUserRequest;
use Symfony\Component\CssSelector\Parser\Reader;
use Symfony\Component\HttpFoundation\Reponse;

class AdminController extends Controller{
    public function home(){
    	return view('admin.home');
    }

    public function getCreateUser(){
    	return view('admin.create-user');
    }

    public function saveCreateUser(CreateUserRequest $request){
    	$user = new User;
    	$user->user_guid = Uuid::uuid();
    	$user->firstname = $request->firstname;
    	$user->middlename = $request->middlename;
    	$user->lastname = $request->lastname;
    	$user->username = $request->username;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->credential = 'registrar';
    	$user->save();
    }

    public function getUser(){
    	$users = User::where('credential', 'registrar')->get();
    	return view('admin.user', compact('users'));
    }

    public function getUserUpdate($id){
    	$user = User::find($id);
    	return view('admin.update-user', compact('user'));
    }

    public function updateUser(UpdateUserRequest $request){
    	$user = User::find($request->id);
        $user->firstname = ucfirst($request->firstname);
        $user->middlename = ucfirst($request->middlename);
        $user->lastname = ucfirst($request->lastname);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();
    }

    // students
    public function getCreateStudent(){
        return view('admin.create-student');
    }

    public function cvs(){
        $csv = new Reader('export.csv');
        return $csv->toArray();
    }
}
