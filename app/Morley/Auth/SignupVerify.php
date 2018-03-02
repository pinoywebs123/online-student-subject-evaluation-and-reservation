<?php 

namespace App\Morley\Auth;

use Illuminate\Http\Request;
use App\User;
use App\StudentVerify;
use Auth;
use Illuminate\Support\Facades\Mail;
class SignupVerify {

	private $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function signupme(){
		$coded = str_random(10);
		 // $data = array('title'=> 'NORSU BCC 1 Online Inquiry and Reservation',
   //                'content'=> 'Hi this is mai mai. Thank you for registering. this is code: '.$coded,
   //                'email'=> $this->request['email']
   //                );
   //         Mail::send('auth.email', $data, function($message) use ($data){
   //          $message->to($data['email'])->subject('You have successfully Registered.! ');
   //         });

		$user = new User;
		$user->id = $this->request['id'];
		$user->fname = $this->request['first_name'];
		$user->mname = $this->request['middle_name'];
		$user->lname = $this->request['last_name'];
		$user->contact = $this->request['contact'];
		$user->address = $this->request['address'];
		$user->course  = $this->request['course'];
		$user->email = $this->request['email'];
		$user->password = bcrypt($this->request['password']);
		$user->status_id = 5;
		$user->role_id  = 2;
		$user->save();
		
		$code = new StudentVerify;
		$code->user_id = $this->request['id'];
		$code->codes = $coded;
		$code->save();

		

		return redirect()->back()->with('register', 'You have registered successfully!');
	}
}
