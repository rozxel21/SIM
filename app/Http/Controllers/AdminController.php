<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Faker\Provider\Uuid;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\updateUserRequest;

use Validator;
use Input;
use File;

class AdminController extends Controller{
    public function home(){
    	return view('admin.home');
    }

    public function getCreateUser(){
    	return view('admin.create-user');
    }

    public function saveCreateUser(CreateUserRequest $req){
    	$user = new User;
    	$user->user_guid = Uuid::uuid();
    	$user->firstname = $req->firstname;
    	$user->middlename = $req->middlename;
    	$user->lastname = $req->lastname;
    	$user->username = $req->username;
    	$user->email = $req->email;
    	$user->password = bcrypt($req->password);
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

    public function updateUser(UpdateUserRequest $req){
    	$user = User::find($req->id);
        $user->firstname = ucfirst($req->firstname);
        $user->middlename = ucfirst($req->middlename);
        $user->lastname = ucfirst($req->lastname);
        $user->username = $req->username;
        $user->email = $req->email;
        $user->status = $req->status;
        $user->save();
    }

    // students
    public function getCreateStudent(){
        return view('admin.create-student');
    }

    public function saveFile(Request $req){

       /* $csvFile = Input::file('file');*/
      /* $x = 'x';
       $file = $req->file('file');
       $extention = $file->getClientOriginalExtension();
       
       $rules = array(
            'data' => 'mimes:cvs'
        );

       $validation = Validator::make($file, $rules);
        
        if($validation->fail()){
            return 'okay';
        }*/
        $this->validate($req, [
            'file' => 'required|mimes: cvs,txt',
        ]);
      

      /* $file = Input::file('image');
        $soliste = Soliste::findOrFail(Input::get('id'));


        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }*/
    
        /*$file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle) ) {
            $line_of_text = fgetcsv($file_handle, 1024);
            $students[] = array(
                'idno' => $line_of_text[0],
                'lastname' => $line_of_text[2],
                'firstname' => $line_of_text[3],
                'middlename' => $line_of_text[4],
                'section' => $line_of_text[5],
                'course' => $line_of_text[6],
                'college' => $line_of_text[7]
            );
        }
        fclose($file_handle);

        foreach ($students as $student) {
            $stud = new Student;
            $stud->idno = $student['idno'];
            $stud->firstname = $student['firstname'];
            $stud->middlename = $student['middlename'];
            $stud->lastname = $student['lastname'];
            $stud->college = $student['college'];
            $stud->course = $student['course'];
            $stud->section = $student['section'];
            $stud->save();
        }*/
    }
}
