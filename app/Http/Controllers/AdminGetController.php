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

    public function getCreateElective($guid){
        $curriculum =  Curriculum::with('getCourse', 'getMajor')->where('curriculum_guid', Base32::decode($guid))->get()->first();
        $subjects = Prospectus::with('getCatalog')->where('curriculum', Base32::decode($guid))->get();
        return view('admin.prospectus', compact('curriculum', 'subjects'));
    }

    public function searchSubject(){
        $subjects = Subject::All('catalog_no')->toArray();
        $list= array();
        foreach ($subjects as $subject) {
            array_push($list, $subject['catalog_no']);
        }
        return $list;
    }

    public function getSubjectByCatalog($catalog){
        $subject = Subject::where('catalog_no', Base32::decode($catalog))->get()->first();
        return $subject;
    }

    public function viewCurriculum(){
        $curricula = Curriculum::with('getCourse', 'getMajor')->get();
        return view('admin.curriculum', compact('curricula'));
    }
}
