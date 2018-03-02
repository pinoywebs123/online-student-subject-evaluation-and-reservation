<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\StudentVerify;
class VerifyController extends Controller
{
    public function very_student($id){
        $find = User::findOrFail($id);
        if($find->status_id == 5){
        	Auth::logout();
        	return view('auth.verifystudent');
        }else {
        	return "Never Ever tried to do this thing bruhhh!!!";
        }
    }

    public function verify_now_morley(Request $request){
    	$this->validate($request, [
    		'codes'=> 'required|max:11'
    	]);
    	$find = StudentVerify::where('codes', $request['codes'])->first();
    	if($find){

    		 User::where('id', $find->user_id)->update(['status_id'=> 1]);
    		$find->delete();

    		return redirect()->route('login')->with('verify', 'Student Account Verify Successfully!');
    	}
    }

    
}
