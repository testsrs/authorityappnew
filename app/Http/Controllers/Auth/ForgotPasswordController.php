<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Transformers\Json;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\Product;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function getResetToken(Request $request)
    {
			$validator = Validator::make($request->all(), [
				'email' => 'required|email'
		]);

			// then, if it fails, return the error messages in JSON format
			if ($validator->fails()) {    
				 return response()->json(['status'=>'error','message'=>$validator->messages()], 200);          
				
			}
		
            $user = User::where('email', $request->input('email'))->first();
            
            
            if (!$user) {
                return response()->json(['status'=>'error','message'=>'User not found'], 200);    
            }
            $token = $this->broker()->createToken($user);
            return response()->json(['token' => $token]);
        
    }
}
