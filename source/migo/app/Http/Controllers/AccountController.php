<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AccountController extends Controller
{
    public function userCreate(Request $req){

        return "creating";
    }
    public function userLogout(){
        Session::flush();
        //return redirect('/login');
        return back();
    }
    public function userLogin(Request $req){

    	if($req->has('_u') && $req->has('_p')){
    		if(strlen(trim($req->input('_u'))) > 0){
    			if(strlen(trim($req->input('_p'))) > 0){
    				$user = trim($req->input('_u'));
    				$pass = trim($req->input('_p'));

    				if($user == 'admin' && $pass == 'admin'){

                        $req->session()->put('user', $user);
                        //$req->session()->put('user_id', $data['_id']);
    					return response()->json(['msg' => 'login success', 'data' => '', 'status' => 200]);
    				}
    				else{
                        return response()->json(['msg' => 'userid and password didn\'t matched', 'data' => '', 'status' => 200]);
    				}
    			}
    			else{
    				return response()->json(['msg' => 'password required', 'data' => '', 'status' => 400], 400);
    			}
    		}
    		else{
    			return response()->json(['msg' => 'user id required', 'data' => '', 'status' => 400], 400);
    		} 
    	}
    	else{
            return response()->json(['msg' => 'required parameter missing or invalid', 'data' => '', 'status' => 400], 400);
    	}
    	
    }
}
//return response()->json(['msg' => 'something went wrong. try again.', 'data' => '', 'status' => 500], 500);
