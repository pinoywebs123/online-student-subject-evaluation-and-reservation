<?php 

namespace App\Morley\Auth;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginVerify{
	private $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function log_me(){
		

		if(Auth::attempt(['id'=> $this->request['student_id'], 'password'=> $this->request['password']])){
			if(Auth::user()->status_id == 0){
				Auth::logout();
				return 'Account is Disabled';
			}

			if(Auth::user()->role_id == 1){
				return redirect()->route('admin_main');
			}else if(Auth::user()->role_id == 2){
				if(Auth::user()->status_id == 5){
					
					return redirect()->route('very_student', ['id'=> Auth::id()]);
				}else{
					return redirect()->route('student_main');
				}
				

			}else if(Auth::user()->role_id == 3){
				return redirect()->route('staff_main');
			}
		}else{
			return redirect()->back()->with('err', 'Invalid Student I.D and Password');
		}
	}
}