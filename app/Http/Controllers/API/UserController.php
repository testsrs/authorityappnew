<?php
namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Mail;
use App\Mail\Product;

class UserController extends Controller
{
	
	public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            
            $success['role'] = $user['role'];
            $success['id'] = $user['id'];
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['status'=>'success','message'=>'Login success','user' => $success], $this->successStatus);
        }
        else{
            return response()->json(['status'=>'error','message'=>'Unauthorised'], 401);
        }
    }


    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
            'c_password' => 'required|same:password',
        ]);


        if ($validator->fails()) {
            return response()->json(['status'=>'error','message'=>$validator->errors()], 401);            
        }
        
        
        $user = DB::table('users')->where('email',$request['email'])->first();
        
        
        if($user){
             return response()->json(['status'=>'error','message'=>'User with email already exist'], 401);
		}
       
        
         if(!$user){
             //user is not found 
		 
      


				$input = $request->all();
				$input['password'] = bcrypt($input['password']);
				$user = User::create($input);
				$success['token'] =  $user->createToken('MyApp')->accessToken;
				$success['username'] =  $user->username;
				$success['email'] =  $user->email;
				$success['role'] =  $user->role;
				
				return response()->json(['status'=>'success','message'=>'Registered successfully','user' => $success], $this->successStatus);


		}
    }


  
    /**
     * User List api
     *
     * @return \Illuminate\Http\Response
     */
    
    public function userlist(){
		
		if(Auth::user()->role =='admin'){
				 $users = DB::table('users')->get();
				 return response()->json(['status'=>'success','message'=>'User list','users' => $users]);
		}else{
				 return response()->json(['status'=>'error','message'=>'You dont have access to this service']);
		}
		
	}
}
