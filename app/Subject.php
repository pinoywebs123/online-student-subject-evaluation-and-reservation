<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StudentSubject;
class Subject extends Model
{
    public function requisite(){
    	return $this->hasOne('App\Requiresite');
    }

    public function students($subject_id){
    	return StudentSubject::where('subject_id', $subject_id)->count();
    }
    
     public function subject_payment(){
    	return $this->hasOne('App\SubjectPayment', 'student_subject_id','id');
    }
}
