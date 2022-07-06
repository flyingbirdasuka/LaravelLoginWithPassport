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

class UserController extends Controller
{
    public function user(){
    	return Auth::user();
    }
}
