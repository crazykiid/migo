<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function userCreate(Request $req){

        if($req->has('_name', '_email', '_contact', '_pass'))
        {
            $u_name = $req->_name;
            $u_email = $req->_email;
            $u_contact = $req->_contact;
            $u_pass = Hash::make(trim($req->_pass));

            try
            {
                $result = DB::table('user_accounts')
                    ->insert(['_name' => $u_name, '_email' => $u_email, '_contact' => $u_contact, '_password' => $u_pass, '_status' => 1]);
                if($result)
                {
                    Session::flash('res_title', 'Success!');
                    Session::flash('res_msg', 'Account created.');
                    Session::flash('res_type', 'success');
                    return back();
                }
                else
                {
                    Session::flash('res_title', 'Error!');
                    Session::flash('res_msg', 'Please, try again.');
                    Session::flash('res_type', 'alert');
                    return back();
                }
            }
            catch(\Exception $e)
            {
                Session::flash('res_title', 'Error Occurred!');
                Session::flash('res_msg', 'Something went wrong, try again.');
                Session::flash('res_type', 'alert');
                return back();
            }
        }
        else
        {
            Session::flash('res_title', 'Invalid!');
            Session::flash('res_msg', 'Required parameter missing or invalid.');
            Session::flash('res_type', 'alert');
            return back();
        }
    }

    public function userLogout(){
        Session::flush();
        //return redirect('/login');
        return back();
    }
    public function userLogin(Request $req){

        // conditions
    	if($req->has('_u') && $req->has('_p')){
    		if(strlen(trim($req->input('_u'))) > 0){
    			if(strlen(trim($req->input('_p'))) > 0){

    				$u_email = trim($req->input('_u'));
    				$u_pass = trim($req->input('_p'));

                    $res_title = '';
                    $res_msg = '';
                    $res_type = '';
                    $res_code = 200;
                    try
                    {
                        $result = DB::table('user_accounts')
                            ->where('_email', $u_email)
                            ->where('_status', 1)
                            ->first();
                        if($result && Hash::check($u_pass, $result->_password))
                        {
                            $db_cart = [];
                            $have_cart = false;
                            $session_cart = [];
                            $updated_cart = [];
                            // check database
                            $cart = DB::table('user_carts')
                                    ->where('_id', $result->_id)
                                    ->select('_cart','_cart_id')
                                    ->first();
                            if($cart){
                                $have_cart = true;
                                $db_cart = json_decode($cart->_cart, true);
                            }

                            // check session
                            if($req->session()->has('user_cart')){
                                $session_cart = $req->session()->get('user_cart');
                            }

                            $updated_cart = array_unique(array_merge($db_cart, $session_cart), SORT_REGULAR);

                            $j_cart = json_encode($updated_cart);
                            if($have_cart)
                            {
                                $save = DB::table('user_carts')
                                        ->where('_cart_id', $cart->_cart_id)
                                        ->update(['_cart' => $j_cart]);
                            }
                            else
                            {
                                $save = DB::table('user_carts')
                                        ->insert(['_id' => $result->_id, '_cart' => $j_cart]);
                            }

                            
                            $req->session()->put('user_cart', $updated_cart);
                            $req->session()->put('user_id', $result->_id);
                            $req->session()->put('user_email', $result->_email);
                            $req->session()->put('username', $result->_name);

                            $res_title = 'Success!';
                            $res_msg = 'Login success.';
                            $res_type = 'success';
                        }
                        else
                        {
                            $res_title = 'Invalid!';
                            $res_msg = 'Email and password didn\'t matched.';
                            $res_type = 'alert';
                        }
                    }
                    catch(\Exception $e)
                    { dd($e);
                        $res_title = 'Error Occurred!';
                        $res_msg = 'Something went wrong, try again.';
                        $res_type = 'alert';
                    }
    			}
    			else{
                    $res_title = 'Invalid!';
                    $res_msg = 'Password required.';
                    $res_type = 'alert';
                    $res_code = 400;
    			}
    		}
    		else{
                $res_title = 'Invalid!';
                $res_msg = 'User id required.';
                $res_type = 'alert';
                $res_code = 400;
    		} 
    	}
    	else{
            $res_title = 'Invalid!';
            $res_msg = 'Required parameter missing or invalid.';
            $res_type = 'alert';
            $res_code = 400;
    	}

        //response
        if($req->has('_t') && $req->has('_t') == 'ajax')
        {
            return response()->json(['title' => $res_title, 'message' => $res_msg, 'type' => $res_type, 'data' => '', 'status' => $res_code], $res_code);
        }
        else
        {
            Session::flash('res_title', $res_title);
            Session::flash('res_msg', $res_msg);
            Session::flash('res_type', $res_type);
            if($res_title == 'Success!')
            {
                return redirect('/');
            }
            else
            {
                return back();
            }
        }
    }
}
