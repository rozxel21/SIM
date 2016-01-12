<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table = 'students';

      protected $fillable = [
      	'stud_idno',
      	'firstname', 
      	'middlename', 
      	'lastname', 
      	'college', 
      	'corse', 
      	'yr_sec', 
      	'status'
      ];
}
