<?php 

namespace App\Morley\Admin;

use Illuminate\Http\Request;
use App\Requiresite;
use App\Subject;

class AddSubjectVerify {

	private $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function subjectverify(){
		
		$subject = new Subject;
		$subject->course = $this->request['course'];
		$subject->unit = $this->request['unit'];
		$subject->department_id = $this->request['department'];
		$subject->subject_code = $this->request['new_subject_code'];
		$subject->subject_description = $this->request['new_subject_description'];
		$subject->status_id = 1;
		$subject->semester = $this->request['semester'];
		$subject->regular = $this->request['regular'];
		$subject->save();

		$pre = new Requiresite;
		$pre->subject_id = $subject->id;
		$pre->subject_code = $this->request['requisite_subject_code'];
		$pre->subject_description = $this->request['requisite_subject_description'];
		$pre->save();

		return redirect()->back()->with('info', 'Insert new subject and pre-requisite successfully!');
	}
}