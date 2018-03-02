<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Subject;
use App\Inquiry;
use App\StudentSubject;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Http\Requests\student\addinquiry;
use App\Morley\Student\AddInquiryVerify;
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

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('studentcheck');
    }
    public function student_main(){
    	$first = Subject::where('department_id',1)->where('status_id',1)->get();
        return view('student.list.main', compact('first'));
    }

    public function student_main_second(){
    	$second = Subject::where('department_id',2)->where('status_id',1)->get();
    	return view('student.list.second', compact('second'));
    }

    public function student_main_third(){
    	$third = Subject::where('department_id',3)->where('status_id',1)->get();
    	return view('student.list.third', compact('third'));
    }

    public function student_main_fourth(){
    	 $fourth = Subject::where('department_id',4)->where('status_id',1)->get();
    	 return view('student.list.fourth', compact('fourth'));
    }

    public function student_main_fifth(){
        $fifth = Subject::where('department_id',5)->where('status_id',1)->get();
         return view('student.list.fifth', compact('fifth'));
    }

    public function student_logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function student_activity(){

        $activity = StudentSubject::where('student_id', Auth::id())->get();
    	return view('student.activity.activity', compact('activity'));
    }

    public function student_inquiries(){
         $inquiry = Inquiry::where('student_id', Auth::id())->get();
    	return view('student.inquiry.inquiry', compact('inquiry'));
    }

    public function student_reservation($id){
    	$find = Subject::findOrFail($id);
    	return view('student.list.view_subject',compact('find'));
    }

    public function student_inquire_now(){
       
        return view('student.inquiry.create');
    }

    public function student_inquiry_check(addinquiry $check, AddInquiryVerify $verify){
        return $verify->inquiryCheck();
    }

    public function studnet_reserve_me_now($id){

        $subject = Subject::findOrFail($id);
        if($subject->requisite){
             if($subject->requisite['subject_code'] != "none"){
                 $req = StudentEvaluation::where('student_id', Auth::id())->get();
                 foreach($req as $mor){

                    if($mor->subject->subject_code == $subject->requisite['subject_code']){
                        

                        $check = StudentSubject::where('student_id', Auth::id())->where('subject_id', $id)->first();
                            if($check){
                                return redirect()->back()->with('check', 'You have already reserve this subject.');
                            }

                            $data = array('title'=> 'NORSU BCC 1 Online Inquiry and Reservation',
                                      'content'=> 'Hi this is Mai mai thank you for choosing your subject.'.$subject->subject_code,
                                      'email'=> Auth::user()->email
                                      );
                               Mail::send('auth.email', $data, function($message) use ($data){
                                $message->to($data['email'])->subject('You have successfully reserved the subject: ');
                               });

                           $reserve = new StudentSubject;
                           $reserve->student_id  = Auth::id();
                           $reserve->subject_id = $id;
                           $reserve->status_id = 1;
                           $reserve->save();


                           $smsGateway = new SmsGateway('etalyano69@gmail.com', '143143');

                            $deviceID = 78266;
                            $number = Auth::user()->contact;
                            $message = 'Dear student you have been reserved successfully to'.$subject->subject_code;



                            //Please note options is no required and can be left out
                            $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);

                           

                           return redirect()->back()->with('ok', 'You have reserved for this subject successfully!');
                    }
                 }
                 return redirect()->back()->with('not', 'You have reserved for this subject successfully!');
             }
            
        }
      
        $check = StudentSubject::where('student_id', Auth::id())->where('subject_id', $id)->first();
        if($check){
            return redirect()->back()->with('check', 'You have already reserve this subject.');
        }

        $data = array('title'=> 'NORSU BCC 1 Online Inquiry and Reservation',
                  'content'=> 'Hi this is Mai mai thank you for choosing your subject.'.$subject->subject_code,
                  'email'=> Auth::user()->email
                  );
           Mail::send('auth.email', $data, function($message) use ($data){
            $message->to($data['email'])->subject('You have successfully reserved the subject: ');
           });

       $reserve = new StudentSubject;
       $reserve->student_id  = Auth::id();
       $reserve->subject_id = $id;
       $reserve->status_id = 1;
       $reserve->save();


       $smsGateway = new SmsGateway('etalyano69@gmail.com', '143143');

        $deviceID = 78266;
        $number = Auth::user()->contact;
        $message = 'Dear student you have been reserved successfully to'.$subject->subject_code;



        //Please note options is no required and can be left out
        $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);

       

       return redirect()->back()->with('ok', 'You have reserved for this subject successfully!');
    }

    public function student_settings(){
        return view('student.settings.setting');
    }

    public function student_settings_check(Request $request){
        $this->validate($request, [
            'new_password'=> 'required|max:12|min:6',
            'repeat_password'=> 'required|same:new_password'
        ]);

         $user = User::findOrFail(Auth::id());
         $user->update(['password'=> bcrypt($request['new_password'])]);
         return redirect()->back()->with('pass_change', 'Password has been successfully updated!');
    }

    public function student_evaluated(){
        $subjects = StudentEvaluation::where('student_id', Auth::id())->get();
        return view('student.eval.list', compact('subjects'));
    }
}
