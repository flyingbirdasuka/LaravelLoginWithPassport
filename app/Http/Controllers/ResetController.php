<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetRequest;
use Mail;
use App\Mail\ForgetMail;

class ResetController extends Controller
{
    public function resetpassword(ResetRequest $request){
    	$email = $request->email;
    	$token = $request->token;
    	$password = Hash::make($request->password);
    	$emailcheck = DB::table('password_resets')->where('email', $email)->first();
    	$pincheck = DB::table('password_resets')->where('token', $token)->first();

    	if(!$emailcheck){
    		return response([
    			'message' => 'Email not found'
    		], 401);
    	}
    	if(!$pincheck){
    		return response([
    			'message' => 'Pincode invalid'
    		], 401);
    	}
    	DB::table('users')->where('email', $email)->update(['password'=> $password]);
    	DB::table('password_resets')->where('email', $email)->delete();
    	return response([
    			'message' => 'Password changed successfully'
    		], 200);
    }
}
