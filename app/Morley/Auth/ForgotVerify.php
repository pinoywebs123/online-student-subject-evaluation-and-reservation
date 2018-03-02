<?php 

namespace App\Morley\Auth;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;


class ForgotVerify {

	private $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function forget_me(){
		
		 $find = User::where('email', $this->request['email'])->first();
		 

		 if($find){



		 	$data = array('title'=> 'NORSU BCC 1 Online Inquiry and Reservation',
	              'content'=> 'Dear students click link to change password :'.route('forget_password_link', ['id'=> md5($find->id), 'email'=> $find->email]),
	              'email'=> $this->request['email']
	              );
	       Mail::send('auth.email', $data, function($message) use ($data){
	        $message->to($data['email'])->subject('NORSU BCC 1 Online Inquiry and Reservation');
	       });


		 	return redirect()->back()->with('suc', 'New Password hs been sent to your email!');
		 }else{
		 	return redirect()->back()->with('err', 'Invalid Email Address');
		 }

	}
}