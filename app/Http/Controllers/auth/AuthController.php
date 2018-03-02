<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\logincheck;
use App\Morley\Auth\LoginVerify;
use App\Morley\Auth\ForgotVerify;
use App\Subject;
use App\Http\Requests\forgetcheck;
use App\User;
use App\Http\Requests\signupcheck;
use App\Morley\Auth\SignupVerify;
class AuthController extends Controller
{
	public function __construct(){
		$this->middleware('authcheck');
	}

	// public function index(){
	// 	$subjects = Subject::where('status_id',1)->paginate(12);
	// 	return view('auth.main', compact('subjects'));
	// }

    public function login(){
    	return view('auth.login');
    }

    public function login_check(logincheck $check, LoginVerify $verify){
    	return $verify->log_me();

  
    }

    public function forgot(){
    	return view('auth.forget');
    }

    public function forgot_check(forgetcheck $check, ForgotVerify $verify){
    	return $verify->forget_me();
    }

    public function signup(){
        return view('auth.signup');
    }

    public function signup_check(signupcheck $check, SignupVerify $verify){
       return $verify->signupme();
        
    }

    public function forget_password_link($id, $email){
       
         $find = User::where('email', $email)->first();
        
        if($find){
            if($id == md5($find->id) ){
                return view('auth.forgotpassword', compact('find'));
            }
            
        }else{
           abort(404);
        }
    }

    public function forget_change_pass(Request $request, $id){
        $this->validate($request, [
            'new_password' => 'required',
            'repeat_password' =>'required|same:new_password'
        ]);

        $update_pass = User::where('id', $id)->update(['password'=> bcrypt($request['new_password'])]);
        if($update_pass){
            return redirect()->route('login')->with('change_pass', 'haha');
        }
    }

    
}
