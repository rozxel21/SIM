<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prospectus extends Model
{
    protected $table = 'prospectus';

    public function getCatalog(){
    	return $this->hasOne('App\Subject', 'catalog_no', 'catalog_no');
    }
}
