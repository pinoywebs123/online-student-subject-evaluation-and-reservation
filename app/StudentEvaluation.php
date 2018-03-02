<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEvaluation extends Model
{
    public function subject(){
    	return $this->belongsTo('App\Subject');
    }

    public function evaluator(){
    	return $this->belongsTo('App\User', 'evaluator_id', 'id');
    }

    public function student(){
    	return $this->belongsTo('App\User', 'student_id', 'id');
    }
}
