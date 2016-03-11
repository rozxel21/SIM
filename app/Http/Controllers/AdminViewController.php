<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MyLibraries\Base32;

use App\User;
use App\College;
use App\Course;
use App\Subject;
use App\Major;
use App\Curriculum;
use App\Prospectus;

class AdminViewController extends Controller
{
	public function home(){
    	return view('admin.home');
    }

    public function createUser(){
    	return view('admin.create-user');
    }
	public function createStudent(){
        $colleges = College::All();
        return view('admin.create-student', compact('colleges'));
    }
	public function user(){
    	$users = User::where('credential', 'registrar')->get();
    	return view('admin.user', compact('users'));
    }
	public function createCollege(){
        return view('admin.create-college');
    }
	public function college(){
        $colleges = College::All();
        return view('admin.college', compact('colleges'));   
    }
	public function course(){
        $courses = Course::All();
        return view('admin.course', compact('courses'));
    }

    public function createCourse(){
        $colleges = College::All();
        return view('admin.create-course', compact('colleges'));
    }

    public function createSubject(){
        return view('admin.create-subject');
    }

    public function subject(){ 
        $subjects = Subject::orderBy('catalog_no')->get();
        return view('admin.subject', compact('subjects'));
    }
	public function createCurriculum(){
        $courses = Course::All();
        return view('admin.create-curriculum', compact('courses'));
    }

    public function curriculum(){
        $curricula = Curriculum::with('getCourse', 'getMajor')->get();
        return view('admin.curriculum', compact('curricula'));
    }

     public function userUpdate($id){
    	$user = User::find($id);
    	return view('admin.update-user', compact('user'));
    }

    public function collegeUpdate($id){
        $college = College::find($id);
        return view('admin.update-college', compact('college'));
    }

    public function courseUpdate($id){
        $colleges = College::All();
        $course = Course::find($id);
        $majors = Major::where('course', $course->course_guid)->get();
        return view('admin.update-course', compact('colleges','course', 'majors'));
    }

    public function subjectUpdate($id){
        $subject = Subject::find($id);
        return view('admin.update-subject', compact('subject'));
    }

     public function prospectus($year ,$guid){
     	$cur = Base32::decode($guid);
        $curriculum =  Curriculum::with('getCourse', 'getMajor')->where('curriculum_guid', $cur)->get()->first();
        $subjects = Prospectus::with('getCatalog')->where('curriculum', $cur)->where('year',$year)->get();
        $semester = array(
            'first' => Prospectus::with('getCatalog')->where('curriculum', $cur)->where('year',$year)->where('semester', 'first')->count(),
            'second' => Prospectus::with('getCatalog')->where('curriculum', $cur)->where('year',$year)->where('semester', 'second')->count(),
            'summer' => Prospectus::with('getCatalog')->where('curriculum', $cur)->where('year',$year)->where('semester', 'summer')->count()
        );

        return view('admin.prospectus', compact('curriculum', 'subjects', 'year', 'semester'));
        //return compact('curriculum', 'subjects', 'year', 'semester');
    }
}
