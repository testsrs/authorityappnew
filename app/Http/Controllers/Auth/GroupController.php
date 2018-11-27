<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Group;
use App\PasswordReset;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


use Illuminate\Support\Facades\Validator;


class GroupController extends Controller
{
    /**
     * Create Group API
     *
     * @return \Illuminate\Http\Response
     */
    public function createGroup(Request $request)
    {
		
		$user = Auth::guard('api')->user();
		
		if(!$user){
			
			return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
		
		
		}
		
	
        $validator = Validator::make($request->all(), [
            
            'name' => 'required',
            'is_private' => 'required',
            'is_approved' => 'required',
            'status'=>'required',
            'color'=>'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['status'=>'error','message'=>$validator->errors()], 401);            
        }
        
        
        if($user['role'] =='admin'){
			
				if($request['is_private'] == 1){ 
						if(empty($request['lock_code'])){
						
																	
						return response()->json(['status'=>'error','message'=>'please enter lock code'], 401);
					
					}
				}
			
				$this->checkUniqueLockCode($request['lock_code']);
        
        
				$group = DB::table('groups')->where('name',$request['name'])->first();
				
				if($group){
					 return response()->json(['status'=>'error','message'=>'Group with same name already exist'], 401);
				}
			   
				
				 if(!$group){
					 
						$input = $request->all();
						
						
						$png_url = "group-".time().".png";  ## renaming file
						$path = public_path() . "/images/group/"; 
						$img = $input['image_url'];
						
						$this->ImageUpload($png_url,$path,$img);
						
						$input['image_url'] =  URL::to('/images/group').'/'.$png_url;
						$input['created_by'] =  $user['id'];	
						
						$newGroup = Group::create($input);
						
						return response()->json(['status'=>'success','message'=>'Group created successfully','group' => $newGroup]);


				}
			
		}else{
						return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
			}
		
    }
    
    
    public function updateGroup(Request $request)
    {
		
		$user = Auth::guard('api')->user();
		
		if(!$user){
			
			return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
		
		}
		
	
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'is_private' => 'required',
            'is_approved' => 'required',
            'status'=>'required',
            'color'=>'required',
            
        ]);


        if ($validator->fails()) {
            return response()->json(['status'=>'error','message'=>$validator->errors()], 401);            
        }
        
        
        if($user['role'] =='admin'){
			
				if($request['is_private'] == 1){ 
						if(empty($request['lock_code'])){
						
																	
						return response()->json(['status'=>'error','message'=>'please enter lock code'], 401);
					
					}
				}
				
				$this->checkUniqueLockCode($request['lock_code'],$request['id']);
        
				$group = DB::table('groups')->where('name',$request['name'])->where('id','!=', $request['id'])->first();
				
				if($group){
					 return response()->json(['status'=>'error','message'=>'Group with name already exist'], 401);
				}
			   
				
				 if(!$group){
					 
						$input = $request->all();
						
						$png_url = "group-".time().".png";  ## renaming file
						$path = public_path() . "/images/group/"; 
						$img = $input['image_url'];
						
						$this->ImageUpload($png_url,$path,$img);
						
						$input['image_url'] =  URL::to('/images/group').'/'.$png_url;
						$input['created_by'] =  $user['id'];						
						
						$updateStatus = DB::table('groups')->where('id', $request['id'])->update($input);
						
						if($updateStatus){
						
							return response()->json(['status'=>'success','message'=>'Group updated successfully','group' => $input]);
						}

				}
			
		}else{
						return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
			}
		
    }

	public function deleteGroup(Request $request)
    {
		$user = Auth::guard('api')->user();
		
		if(!$user){
			
			return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
		
		}
		
	
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json(['status'=>'error','message'=>$validator->errors()], 401);            
        }
        
        
        if($user['role'] =='admin'){
			
			
					  $toDeleteId =  '\"'.trim($request['id']).'\"';
					  
					  $data = Group::where('group_ids','LIKE',"%{$toDeleteId}%")->get();
					  
					  if(!empty($data[0])){
						  
							## delete this group from mass group
						   foreach($data as $key =>$val){
						 
							$subGroups = json_decode($data[$key]['group_ids']); 
							$a = [];
							$a[] = $request['id'];
							
							$arr = array_diff($subGroups,$a);
							$arr =  array_values($arr); 
					  
							$val['group_ids'] = json_encode($arr);
							
							$updateStatus = DB::table('groups')->where('id', $val['id'])->update(array('group_ids'=>$val['group_ids']));
							
						  }
						  
					 }
					  
							$input = $request->all();
							$input['status'] = 3;
							$updateStatus = DB::table('groups')->where('id', $input['id'])->update($input);
							
							if($updateStatus){
							
								return response()->json(['status'=>'success','message'=>'Group deleted successfully','group' => $input]);
								
							}else{
								return response()->json(['status'=>'error','message'=>'Something went wrong!']);
							}
			
		}else{
					return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
			}
		
	}	
	
	public function getPendingJoinRequest()
	{
		$user = Auth::guard('api')->user();
		
		if(!$user){
			
			return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
		
		}
		
		if($user['role'] =='admin'){
			
			$pendinRequest = DB::table('joinRequests')->where('status',1)->get();
			print_r($pendinRequest); exit;
				
				if($group){
					 return response()->json(['status'=>'error','message'=>'Group with name already exist'], 401);
				}
			
			
		}else{
					return response()->json(['status'=>'error','message'=>'You are unauthorised to access this service']);
			}
		
	}
}


