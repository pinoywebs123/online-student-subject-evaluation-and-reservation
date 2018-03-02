<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function login(Request $request){
    	

    	$username = $request->input('id');
        $password = $request->input('password');

        try{
            if(! $token = JWTAuth::attempt(['id'=> $username, 'password'=> $password])){
                return response()->json(['status'=> false]);
            }
        }catch(JWTException $e){
            return response()->json(['error'=> $e],500);
        }

        $user = JWTAuth::toUser($token);


        return response()->json(['status'=> true,'token'=> $token, 'user'=>  $user]);
    }
}
