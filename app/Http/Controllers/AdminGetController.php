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


   

    public function getMajorsFromCourse($courseGuid){
        $majors = Major::where('course', $courseGuid)->get();
        return $majors;
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

    public function getSubjectForPrereq($guid){
        $subjects = Prospectus::where('curriculum', Base32::decode($guid))->orderBy('catalog_no')->get(array('catalog_no'));
        return $subjects;
    }
}
