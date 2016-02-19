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
use App\Curriculum;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateCollegeRequest;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\CreateSubjectRequest;

use App\MyLibraries\Base32;

use Validator;
use Input;
use File;

class AdminSaveController extends Controller
{
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

	public function saveCreateCollege(CreateCollegeRequest $req){
        $college = new College;
        $college->college_guid = Uuid::uuid();
        $college->abrr = $req->abrr;
        $college->name = $req->name;    
        $college->save();
    }

	public function saveCourse(CreateCourseRequest $req){
        $courseGuid = Uuid::uuid();

        $course = new Course;
        $course->course_guid = $courseGuid;
        $course->abrr = $req->abrr;
        $course->name = $req->name;
        $course->college = $req->college;  
        $course->save();
      
        $majors = json_decode($req->majors);
        
        if(count($majors) != 0){
            foreach ($majors as $name) {
                $major = new Major;
                $major->major_guid =  Uuid::uuid();
                $major->name = $name;
                $major->course = $courseGuid;
                $major->save();
            }
        }
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

	public function saveCurriculum(Request $req){
        $guid = Uuid::uuid();;

        $curriculum = new Curriculum;
        $curriculum->curriculum_guid = $guid;
        $curriculum->course = $req->course;
        $curriculum->major = $req->major;
        $curriculum->effective_sy = $req->effective;
        $curriculum->bor_res = $req->bor;
        $curriculum->save();

        return Base32::encode($guid);
    }
}
