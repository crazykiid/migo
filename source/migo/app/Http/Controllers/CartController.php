<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
	public function getCartCount()
    {
            return 3;
    }
	//POST :
    public function addProduct(Request $req)
    {
    	if($req->has('_pid','_q')){
    		$p_id = trim($req->_pid);
    		$p_qty = trim($req->_q);

    		$result = DB::table('products')->where('_id', $p_id)->first();
    		if($result){
    			$max = 1000;
    			if($p_qty && $p_qty <= $max){

    				$cart = [];
    				$user = 1;
    				$old = DB::table('user_accounts')
    					->join('user_carts','user_accounts._id', '=', 'user_carts._id')
    					//->where('user_accounts._status','1')
    					->where('user_accounts._id', $user)
    					->select('user_accounts._status', 'user_carts._cart', 'user_carts._cart_id')
    					->first();
    				if($old)
    				{	// have cart
    					if($old->_cart)
    					{	// have items
    						$o_cart = json_decode($old->_cart, true);
    						$n_cart = [];
    						$n_exist = false;
    						foreach($o_cart as $item){

    							if($item['product_id'] == $p_id)
    							{
    								if(($item['quantity'] + $p_qty) <= $max)
    								{
    									$n_exist = true;
    									$item['quantity'] = $item['quantity'] + $p_qty;
    									$n_cart[] = $item;
    								}
    								else
    								{
										return response()->json(['msg' => 'max quantity reached', 'data' => $o_cart, 'status' => 200]);
    								}
    							}
    							else
    							{
									$n_cart[] = $item;
    							}
    						}
    						if($n_exist == false){
								$item = ['product_id' => $p_id, 'quantity' => $p_qty];
								$n_cart[] = $item;
    						}
    						$n_cart = json_encode($n_cart);
    						// save cart
    						$result = DB::table('user_carts')
    							->where('_cart_id', $old->_cart_id)
    							->update(['_cart' => $n_cart]);
    						return response()->json(['msg' => 'success', 'data' => json_decode($n_cart), 'status' => 200]);
    					}
    					else
    					{	// empty cart
    						$item = ['product_id' => $p_id, 'quantity' => $p_qty];
    						$cart[] = $item;
    						$cart = json_encode($cart);
    						// save cart
    						$result = DB::table('user_carts')
    							->where('_cart_id', $old->_cart_id)
    							->update(['_cart' => $cart]);
							return response()->json(['msg' => 'success', 'data' => json_decode($cart), 'status' => 200]);
    					}
    				}
    				else
    				{	// no cart
    					$item = ['product_id' => $p_id, 'quantity' => $p_qty];
    					$cart[] = $item;
    					$cart = json_encode($cart);
    					// save cart
    					$result = DB::table('user_carts')
    						->insert(['_id' => $user, '_cart' => $cart]);
						return response()->json(['msg' => 'success', 'data' => json_decode($cart), 'status' => 200]);
    				}
    				//return response()->json(['msg' => 'success', 'data' => $cart, 'status' => 200]);
    			}
    			else{
    				return "invalid quantity.";
    			}
    		}
    		else{
    			return "product doesn't exist.";
    		}
    	}
    	else{
    		return response()->json(['msg' => 'required parameter missing or invalid', 'data' => '', 'status' => 400], 400);
    	}
    }

    //POST :
    public function removeProduct(Request $req)
    {
    }
}
