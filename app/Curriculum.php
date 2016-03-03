<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'curricula';
    protected $fillable = ['course'];

    public function getCourse(){
    	return $this->hasOne('App\Course', 'course_guid', 'course');
    }

    public function getMajor(){
    	return $this->hasOne('App\Major', 'major_guid', 'major');
    }
}
