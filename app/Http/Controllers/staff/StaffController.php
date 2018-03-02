<?php

namespace App\Http\Controllers\staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use Auth;
use App\User;
use App\StudentSubject;
class StaffController extends Controller
{
    public function __construct(){
        $this->middleware('staffcheck');
    }

    public function staff_main(){
    	$first = Subject::where('department_id',1)->get();
    	return view('staff.reserves.main', compact('first'));
    }

    public function staff_second(){
    	$second = Subject::where('department_id',2)->get();
    	return view('staff.reserves.second', compact('second'));
    }

    public function staff_third(){
    	$third = Subject::where('department_id',3)->get();
    	return view('staff.reserves.third', compact('third'));
    }

    public function staff_fourth(){
    	 $fourth = Subject::where('department_id',4)->get();
    	 return view('staff.reserves.fourth', compact('fourth'));
    }

    public function staff_fifth(){
        $fifth = Subject::where('department_id',5)->where('status_id',1)->get();
         return view('staff.reserves.fifth', compact('fifth'));
    }

    public function view_student_list($id){

    	$find = Subject::findOrFail($id);
        $students = StudentSubject::where('subject_id', $id)->where('status_id',1)->get();
        return view('staff.reserves.view', compact('find', 'students'));
    }



    public function staff_subjects(){
    	$subjects = Subject::all();
    	return view('staff.subjects.list', compact('subjects'));
    }

    public function staff_students(){
    	$students = User::where('role_id',2)->get();
    	return view('staff.students.list', compact('students'));
    }

    public function staff_logout(){
    	Auth::logout();
    	return redirect('/');
    }

    public function staff_settings(){
        return view('staff.settings.setting');
    }

    public function staff_settings_check(Request $request){
        $this->validate($request, [
            'new_password'=> 'required|max:12|min:6',
            'repeat_password'=> 'required|same:new_password'
        ]);

         $user = User::findOrFail(Auth::id());
         $user->update(['password'=> bcrypt($request['new_password'])]);
         return redirect()->back()->with('pass_change', 'Password has been successfully updated!');
    }
}
