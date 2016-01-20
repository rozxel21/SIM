<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Factory;
use Faker\Provider\Uuid;

use App\User;
use App\Student;
use App\College;
use App\Course;
use App\Subject;
use App\Major;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\updateUserRequest;
use App\Http\Requests\CreateCollegeRequest;
use App\Http\Requests\UpdateCollegeRequest;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\CreateSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;

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
        $colleges = College::All();
        return view('admin.create-student', compact('colleges'));
    }

    public function saveFile(){

        $csvFile = Input::file('file');
    
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle) ) {
            $line_of_text = fgetcsv($file_handle, 1024);
            if($line_of_text != null){
                 $studentData[] = array(
                    'stud_idno' => $line_of_text[0],
                    'lastname' => $line_of_text[2],
                    'firstname' => $line_of_text[3],
                    'middlename' => $line_of_text[4],
                    'yr_sec' => $line_of_text[5],
                    'course' => $line_of_text[6],
                    'college' => $line_of_text[7]
                );
            }
        }
        fclose($file_handle);

        $errorList = array();
        $i = 1;
        foreach ($studentData as $student) {
           $validator = Validator::make($student, [
                'stud_idno' => 'unique:students|regex:/^\d{2}-+\d{4}$/',
                'lastname' => 'min:2',
                'firstname' => 'min:2',
            ]);

            if($validator->fails()){
                foreach ($validator->errors()->all() as $err) {
                    $errorList[] = 'Line ' . $i . ' - ' . $err ;
                }
            }else{
                $stud = new Student;
                $stud->student_guid = Uuid::uuid();
                $stud->stud_idno = $student['stud_idno'];
                $stud->firstname = $student['firstname'];
                $stud->middlename = $student['middlename'];
                $stud->lastname = $student['lastname'];
                $stud->college = $student['college'];
                $stud->course = $student['course'];
                $stud->yr_sec = $student['yr_sec'];
                $stud->save();
            }
            $i++;
        } 

        return $errorList;  
    }

    // colleges
    public function getCreateCollege(){
        return view('admin.create-college');
    }

    public function saveCreateCollege(CreateCollegeRequest $req){
        $college = new College;
        $college->college_guid = Uuid::uuid();
        $college->abrr = $req->abrr;
        $college->name = $req->name;    
        $college->save();
    }

    public function getCollege(){
        $colleges = College::All();
        return view('admin.college', compact('colleges'));   
    }

    public function getCollegeUpdate($id){
        $college = College::find($id);
        return view('admin.update-college', compact('college'));
    }

    public function updateCollege(UpdateCollegeRequest $req){
        $college = College::find($req->id);
        $college->abrr = $req->abrr;
        $college->name = $req->name;
        $college->status = $req->status;
        $college->save();
    }

    public function getCourse(){
        $courses = Course::All();
        return view('admin.course', compact('courses'));
    }

    public function getCreateCourse(){
        $colleges = College::All();
        return view('admin.create-course', compact('colleges'));
    }

    public function saveCourse(CreateCourseRequest $req){
        $courseGuid = Uuid::uuid();

        /*$course = new Course;
        $course->course_guid = $courseGuid;
        $course->abrr = $req->abrr;
        $course->name = $req->name;
        $course->college = $req->college;  
        $course->save();*/
        /*foreach ($req->majors as $name) {
           $list[] = array(
                'test' => $name
            );
        }*/
        $ctr = 0;
        $x = $req->majors;
        return $x;
        foreach ($x as $y) {
            $ctr++;
        }


        /*if(count($majors) != 0){
            foreach ($majors as $name) {
                $major = new Major;
                $major->major_guid =  Uuid::uuid();
                $major->name = $name;
                $major->course_guid = $courseGuid;
                $major->save();
            }
        }*/
    }

    public function getCourseUpdate($id){
        $colleges = College::All();
        $course = Course::find($id);
        return view('admin.update-course', compact('colleges','course'));
    }

    public function updateCourse(UpdateCourseRequest $req){
        $course = Course::find($req->id);
        $course->abrr = $req->abrr;
        $course->name = $req->name;
        $course->college = $req->college;
        $course->status = $req->status;
        $course->save();
    }

    // subjects
    public function getCreateSubject(){
        return view('admin.create-subject');
    }

    public function saveSubject(CreateSubjectRequest $req){
        $subject = new Subject;
        $subject->subject_guid = Uuid::uuid();
        $subject->catalog_no = $req->catalog_no;
        $subject->descriptive_title = $req->descriptive_title;
        $subject->lec_units = $req->lec_units;
        $subject->lab_units = $req->lab_units;
        $subject->total_units = $req->total_units;
        $subject->save();
    }

    public function getSubject(){
        $subjects = Subject::All();
        return view('admin.subject', compact('subjects'));
    }

    public function getSubjectUpdate($id){
        $subject = Subject::find($id);
        return view('admin.update-subject', compact('subject'));
    }

    public function updateSubject(UpdateSubjectRequest $req){
        $subject = Subject::find($req->id);
        $subject->catalog_no = $req->catalog_no;
        $subject->descriptive_title = $req->descriptive_title;
        $subject->lec_units = $req->lec_units;
        $subject->lab_units = $req->lab_units;
        $subject->total_units = $req->total_units;
        $subject->status = $req->status;
        $subject->save();


    }
}
