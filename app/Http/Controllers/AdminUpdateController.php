<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Student;
use App\College;
use App\Course;
use App\Subject;
use App\Major;
use App\Curriculum;

use App\Http\Requests\updateUserRequest;
use App\Http\Requests\UpdateCollegeRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Requests\UpdateSubjectRequest;

class AdminUpdateController extends Controller
{
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

    public function updateCollege(UpdateCollegeRequest $req){
        $college = College::find($req->id);
        $college->abrr = $req->abrr;
        $college->name = $req->name;
        $college->status = $req->status;
        $college->save();
    }

    public function updateCourse(UpdateCourseRequest $req){
        $course = Course::find($req->id);
        $course->abrr = $req->abrr;
        $course->name = $req->name;
        $course->college = $req->college;
        $course->status = $req->status;
        $course->save();
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
