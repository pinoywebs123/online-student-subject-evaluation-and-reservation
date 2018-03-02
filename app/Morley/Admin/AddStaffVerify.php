<?php 

namespace App\Morley\Admin;
use Illuminate\Http\Request;
use App\User;

class AddStaffVerify {
	private $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function staff_verify(){
		$user = new USer;
        $user->id = $this->request['id'];
        $user->fname = $this->request['first_name'];
        $user->mname = $this->request['middle_name'];
        $user->lname = $this->request['last_name'];
        $user->contact = $this->request['contact'];
        $user->address = $this->request['address'];
        $user->course = $this->request['course'];
        $user->email  = $this->request['email'];
        $user->password = bcrypt($this->request['password']);
        $user->status_id = 1; 
        $user->role_id = 3;
        $user->save();

        return redirect()->back()->with('suc', 'Staff Added Successfully!');
	}
}