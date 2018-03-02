<?php 

namespace App\Morley\Student;


use Illuminate\Http\Request;
use App\Inquiry;
use App\User;
use Auth;
class AddInquiryVerify{

	private $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function inquiryCheck(){
		
		$inq = new Inquiry;
		$inq->student_id = Auth::id();
		$inq->inquiry_title = $this->request['inquiry_title'];
		$inq->inquiry_content = $this->request['inquiry_content'];
		$inq->status_id = 0;
		$inq->save();

		return redirect()->back()->with('ok', 'You have successfully send an Inquiry for NORSU BCC Admin');
		
	}

}