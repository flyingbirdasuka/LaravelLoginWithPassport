<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ForgetRequest;
use Mail;
use App\Mail\ForgetMail;

class ForgetController extends Controller
{
    public function forgetpassword(ForgetRequest $request){
    	$email = $request->email;
    	if(User::where('email', $email)->doesntExist()){
    		return response([
    			'message' => 'Invalid email'
    		], 401);
    	}
    	$token = rand(10, 100000);
    	try{
    		DB::table('password_resets')->insert([
    			'email' => $email,
    			'token' => $token
    		]);
    		Mail::to($email)->send(new ForgetMail($token));
    		return response([
    			'message' => 'Reset Password Email sent'
    		],200);

    	}catch(Exception $exception){
    		return response([
    			'message' => $exception->getMessage()
    		],400);
    	}
    	
    }
}
