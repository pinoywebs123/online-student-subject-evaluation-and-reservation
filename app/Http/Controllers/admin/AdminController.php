<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Requiresite;
use App\Subject;
use App\Inquiry;
use App\StudentSubject;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\admin\addsubject;
use App\Http\Requests\admin\addStudent;
use App\Http\Requests\admin\addStaff;

use App\Morley\Admin\AddSubjectVerify;
use App\Morley\Admin\AddStaffVerify;
use App\SubjectPayment;
use App\Http\Requests\admin\addEval;
use App\StudentEvaluation;

class SmsGateway {

        static $baseUrl = "https://smsgateway.me";


        function __construct($email,$password) {
            $this->email = $email;
            $this->password = $password;
        }

        function createContact ($name,$number) {
            return $this->makeRequest('/api/v3/contacts/create','POST',['name' => $name, 'number' => $number]);
        }

        function getContacts ($page=1) {
           return $this->makeRequest('/api/v3/contacts','GET',['page' => $page]);
        }

        function getContact ($id) {
            return $this->makeRequest('/api/v3/contacts/view/'.$id,'GET');
        }


        function getDevices ($page=1)
        {
            return $this->makeRequest('/api/v3/devices','GET',['page' => $page]);
        }

        function getDevice ($id)
        {
            return $this->makeRequest('/api/v3/devices/view/'.$id,'GET');
        }

        function getMessages($page=1)
        {
            return $this->makeRequest('/api/v3/messages','GET',['page' => $page]);
        }

        function getMessage($id)
        {
            return $this->makeRequest('/api/v3/messages/view/'.$id,'GET');
        }

        function sendMessageToNumber($to, $message, $device, $options=[]) {
            $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST',$query);
        }

        function sendMessageToManyNumbers ($to, $message, $device, $options=[]) {
            $query = array_merge(['number'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendMessageToContact ($to, $message, $device, $options=[]) {
            $query = array_merge(['contact'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendMessageToManyContacts ($to, $message, $device, $options=[]) {
            $query = array_merge(['contact'=>$to, 'message'=>$message, 'device' => $device], $options);
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        function sendManyMessages ($data) {
            $query['data'] = $data;
            return $this->makeRequest('/api/v3/messages/send','POST', $query);
        }

        private function makeRequest ($url, $method, $fields=[]) {

            $fields['email'] = $this->email;
            $fields['password'] = $this->password;

            $url = smsGateway::$baseUrl.$url;

            $fieldsString = http_build_query($fields);


            $ch = curl_init();

            if($method == 'POST')
            {
                curl_setopt($ch,CURLOPT_POST, count($fields));
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
            }
            else
            {
                $url .= '?'.$fieldsString;
            }

            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_HEADER , false);  // we want headers
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $result = curl_exec ($ch);

            $return['response'] = json_decode($result,true);

            if($return['response'] == false)
                $return['response'] = $result;

            $return['status'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close ($ch);

            return $return;
        }
    }

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('admincheck');
	}
    
    public function admin_main(){
        $subject = Subject::where('status_id',1)->count();
        $student = User::where('status_id',1)->where('role_id',2)->count();
        $inquiry = Inquiry::count();
        $reserve = StudentSubject::where('status_id',1)->count();
    	return view('admin.list.main', compact('subject','student','inquiry','reserve'));
    }

    public function admin_logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function admin_subject(){
        $subjects = Subject::all();
        return view('admin.subject.subject', compact('subjects'));
    }

    public function admin_subject_create(){
        return view('admin.subject.create');
    }

    public function admin_subject_delete($subject_id){
        $find = Subject::findOrFail($subject_id);

        if($find){
            $find->delete();
            return redirect()->back()->with('delete', 'Subject has been Successfully deleted!');
        }
    }

    public function admin_subject_close($subject_id){
         $find = Subject::where('id', $subject_id)->update(['status_id' => 0]);

        if($find){
           
            return redirect()->back()->with('update', 'Subject has been Successfully updated!');
        }
    }

    public function admin_create_check(addsubject $check, AddSubjectVerify $verify){
        return $verify->subjectverify();
    }

    public function admin_inquiry(){
        $inquiry = Inquiry::paginate(10);
        return view('admin.inquiry.inquiry', compact('inquiry'));
    }

    public function admin_inquiry_view($id){
        $find = Inquiry::findOrFail($id);
        $update = Inquiry::where('id', $id)->update(['status_id'=> 1]);
        if($update){
            return view('admin.inquiry.view', compact('find'));
        }

        
    }

    public function admin_reserve(){
        $first = Subject::where('department_id',1)->paginate(12);
        return view('admin.reserve.reserve', compact('first'));
    }

    public function admin_reserve_second(){
        $second = Subject::where('department_id',2)->paginate(12);
        return view('admin.reserve.second', compact('second'));

    }

    public function admin_reserve_third(){
        $third = Subject::where('department_id',3)->paginate(12);
        return view('admin.reserve.third', compact('third'));
    }

    public function admin_reserve_fourth(){
        $fourth = Subject::where('department_id',4)->paginate(12);
        return view('admin.reserve.fourth', compact('fourth'));
    }

    public function admin_reserve_fifth(){
        $fifth = Subject::where('status_id',1)->where('department_id',5)->paginate(12);
        return view('admin.reserve.fifth', compact('fifth'));
    }

    public function admin_view_list($id){
        $find = Subject::findOrFail($id);
        $students = StudentSubject::where('subject_id', $id)->where('status_id',1)->get();
        $counts = StudentSubject::where('subject_id', $id)->where('status_id',1)->count();
        return view('admin.reserve.view', compact('find', 'students','counts'));
    }

    public function admin_students(){
        $students = User::where('role_id',2)->paginate(10);
        return view('admin.student.list', compact('students'));
    }

    public function admin_students_create(){
        return view('admin.student.create');
    }

    public function admin_students_create_check(Request $request,addStudent $check){
        $user = new USer;
        $user->id = $request['id'];
        $user->fname = $request['first_name'];
        $user->mname = $request['middle_name'];
        $user->lname = $request['last_name'];
        $user->contact = $request['contact'];
        $user->address = $request['address'];
        $user->course = $request['course'];
        $user->email  = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->status_id = 1; 
        $user->role_id = 2;
        $user->save();

        return redirect()->back()->with('suc', 'New Student Added Successfully!');
    }

    public function admin_students_upload(){
        return view('admin.student.upload');
    }

    public function admin_staff(){
        $staffs = User::where('role_id',3)->paginate(15);
        return view('admin.staff.list',compact('staffs'));
    }

    public function admin_staff_create(){
        return view('admin.staff.create');
    }

    public function admin_staff_check(addStudent $check, AddStaffVerify $verify){
        return $verify->staff_verify();
    }

    public function admin_disable_user($user_id){
        $find = User::where('id', $user_id)->update(['status_id'=> 0]);

        if($find){
            return redirect()->back()->with('lock', 'Student has been locked Successfully!');
        }
    }

    public function admin_disable_staff($staff_id){
       $find = User::where('id', $staff_id)->update(['status_id'=> 0]);

        if($find){
            return redirect()->back()->with('staff_lock', 'Staff has been locked Successfully!');
        }
    }

    public function admin_inquiry_email($id){

        $find = Inquiry::findOrFail($id);

        $smsGateway = new SmsGateway('etalyano69@gmail.com', '143143');

        $deviceID = 78266;
        $number = $find->student->contact;
        $message = 'Dear student the subject that you have request has been approved';



        //Please note options is no required and can be left out
        $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);

        if($result){
            return redirect()->back()->with('ok_text', 'You have Successfully sent SMS !');
        }else{
            return redirect()->back()->with('no_text', 'Failed to send SMS, Kindly contact the administrator !');

        }
    }

    public function admin_inquiry_sms($id){
             $find = Inquiry::findOrFail($id);

            $data = array('title'=> 'NORSU BCC 1 Online Inquiry and Reservation',
                  'content'=> 'Hi this is Mai mai the subject you have been requested has been approve and open already.You can reserve now!',
                  'email'=> $find->student->email
                  );
           Mail::send('auth.email', $data, function($message) use ($data){
            $message->to($data['email'])->subject('NORSU BCC 1 Online Inquiry and Reservation: ');
           });

           return redirect()->back()->with('ok_email', 'Mail has been sent Successfully !');
    }

    public function subject_tuition(Request $request,$id){
        $find = Subject::findOrFail($id);
        if($find){
            $pay = new SubjectPayment;
            $pay->student_subject_id = $find->id;
            $pay->total_payment = $request['tuition'];
            $pay->save();

            return redirect()->back()->with('ok', 'Tuition has been inserted to this subject Successfully!');
        }
    }

    public function notify_all($id){
        $find = Subject::findOrFail($id);
         $count = StudentSubject::where('subject_id', $id)->count();
         if($count < 1){
            return 'no student to be ano ano u know na';
         }
        if($find){
            $students = StudentSubject::where('subject_id', $id)->get();
            $count = StudentSubject::where('subject_id', $id)->count();
            $tuit = $find->subject_payment->total_payment / $count;
            foreach($students as $stud){
               

               $smsGateway = new SmsGateway('etalyano69@gmail.com', '143143');

            $deviceID = 78266;
            $number = $stud->student->contact;
            $message = 'Dear students the total tuition for this subject is '. $find->subject_payment->total_payment.' divided by the total students reserve for this subject which is '.$count.' then your current tuition now is '.$tuit.'. This is automatic generated text no need to reply. Thanks NORSU BCC CAS!' ;



            //Please note options is no required and can be left out
            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);

            if($result){
                return redirect()->back()->with('ok_text', 'You have Successfully sent SMS to all students reserve in this subject !');
            }
            }
        }
    }

    public function admin_evaluation(){
         $students = User::where('role_id',2)->get();
        return view('admin.eval.student', compact('students'));
    }

    public function admin_evaluation_now($id){
       $find = User::findOrFail($id);

        return view('admin.eval.view', compact('find'));
    }

    public function admin_evaluation_ajax(Request $request, $id){
        $subjects = Subject::where('department_id', $request['year'])->where('status_id',1)->where('semester', $request['semester'])->get();
        return response()->json(['message'=> $subjects]);
    }

    public function admin_eval_me(Request $request,addEval $check,$id){
        if($request['grade'] > 3){
            return redirect()->back()->with('hagbong', 'You are not allowed to evaluated grades below 3.0!');
        }

        $eval = new StudentEvaluation;

        $eval->evaluator_id = Auth::id();
        $eval->student_id = $id;
        $eval->subject_id = $request['subject_code'];
        $eval->year = $request['year'];
        $eval->semester = $request['semester'];
        $eval->grade = $request['grade'];
        $eval->save();
       
       return redirect()->back()->with('eval', 'Student has been Evaluated successfully!!');
    }

    public function admin_search_evaluation(Request $request){
        $this->validate($request, [
            'search'=> 'required'
        ]);
       
         $find = User::where('id',$request['search'])->first();
        if($find){
            return view('admin.eval.search', compact('find'));
        }else{
            return redirect()->back()->with('lock', 'Student I.D Not Found...');
        }
    }

}
