<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Subject;
use App\StudentSubject;

use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Illuminate\Support\Facades\Mail;

use Auth;
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


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firsts = Subject::where('department_id',1)->where('status_id',1)->get();
        foreach($firsts as $first){
            $first->number = $first->students($first->id);
        }

        $seconds = Subject::where('department_id',2)->where('status_id',1)->get();
         foreach($seconds as $second){
            $second->number = $second->students($second->id);
        }

        $thirds = Subject::where('department_id',3)->where('status_id',1)->get();
        
         foreach($thirds as $third){
            $third->number = $third->students($third->id);
        }

        $fourths = Subject::where('department_id',4)->where('status_id',1)->get();
         foreach($fourths as $fourth){
            $fourth->number = $fourth->students($fourth->id);
        }

         $fifths = Subject::where('department_id',5)->where('status_id',1)->get();
         foreach($fifths as $pip){
            $pip->number = $pip->students($pip->id);
        }

        return response()->json(['first'=> $firsts, 'second'=> $seconds, 'third'=> $thirds, 'fourth'=> $fourths,'fifths'=> $fifths]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          


    }

    public function reserve(Request $request){
         $subject = Subject::findOrFail($request->input('subject_id'));

        if(! $user = JWTAuth::parseToken()->authenticate()){
            return response()->json(['message'=> 'invaild user']);
            }

            $check = StudentSubject::where('student_id', $user->id)->where('subject_id', $request->input('subject_id'))->first();

            if($check){
                return response()->json(['message'=> 'exist']);
            }

            $data = array('title'=> 'NORSU BCC 1 Online Inquiry and Reservation',
                  'content'=> 'Hi this is Mai mai thank you for choosing your subject.'.$subject->subject_code,
                  'email'=> Auth::user()->email
                  );
           Mail::send('auth.email', $data, function($message) use ($data){
            $message->to($data['email'])->subject('You have successfully reserved the subject: ');
           });


           $smsGateway = new SmsGateway('etalyano69@gmail.com', '143143');

        $deviceID = 78266;
        $number = Auth::user()->contact;
        $message = 'Dear student you have been reserved successfully to'.$subject->subject_code;



        //Please note options is no required and can be left out
        $result = $smsGateway->sendMessageToNumber($number, $message, $deviceID);



            $reser = new StudentSubject;
            $reser->student_id = $user->id;
            $reser->subject_id = $request->input('subject_id');
            $reser->status_id = 1;
            $reser->save();

            return response()->json(['message'=> 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $subject = Subject::where('id',$id)->first();
        $subject->requisite;


        return response()->json(['subject'=> $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
