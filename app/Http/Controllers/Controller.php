<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Image;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    
    ## function to check group lock code
    public function checkUniqueLockCode($lock_code = false,$id = false){
		
		if(!empty($id)){
			$status = DB::table('groups')->where('id','!=', $id)->where('lock_code','=',$lock_code)->first();
		}else{
			$status = DB::table('groups')->where('lock_code',$lock_code)->first();
		}
		
		if(!empty($status)){
			
			echo json_encode(['status'=>'error','message'=>'This lock code already in use']);
			exit;
			
		}
	}
	
	
	## common function to upload image
	public function ImageUpload($png_url = false,$path = false,$img = false){
			
			Image::make($img)->resize(320, 240)->save($path. $png_url);
		
	}
}
