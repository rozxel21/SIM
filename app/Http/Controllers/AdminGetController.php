<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\College;
use App\Course;
use App\Subject;
use App\Major;

class AdminGetController extends Controller
{
	public function home(){
    	return view('admin.home');
    }

    public function getCreateUser(){
    	return view('admin.create-user');
    }

    public function getCreateStudent(){
        $colleges = College::All();
        return view('admin.create-student', compact('colleges'));
    }

    public function getUser(){
    	$users = User::where('credential', 'registrar')->get();
    	return view('admin.user', compact('users'));
    }

    public function getUserUpdate($id){
    	$user = User::find($id);
    	return view('admin.update-user', compact('user'));
    }

    public function getCreateCollege(){
        return view('admin.create-college');
    }
	public function getCollege(){
        $colleges = College::All();
        return view('admin.college', compact('colleges'));   
    }

    public function getCollegeUpdate($id){
        $college = College::find($id);
        return view('admin.update-college', compact('college'));
    }

    public function getCourse(){
        $courses = Course::All();
        return view('admin.course', compact('courses'));
    }

    public function getCreateCourse(){
        $colleges = College::All();
        return view('admin.create-course', compact('colleges'));
    }

    public function getCourseUpdate($id){
        $colleges = College::All();
        $course = Course::find($id);
        $majors = Major::where('course', $course->course_guid)->get();
        return view('admin.update-course', compact('colleges','course', 'majors'));
    }

    public function getCreateSubject(){
        return view('admin.create-subject');
    }

    public function getSubject(){
        $subjects = Subject::All();
        return view('admin.subject', compact('subjects'));
    }

    public function getSubjectUpdate($id){
        $subject = Subject::find($id);
        return view('admin.update-subject', compact('subject'));
    }

    public function getMajorsFromCourse($courseGuid){
        $majors = Major::where('course', $courseGuid)->get();
        return $majors;
    }

    public function getCurriculum(){
        $courses = Course::All();
        return view('admin.create-curriculum', compact('courses'));
    }
}
