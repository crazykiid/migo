<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
	public function cart(Request $req)
    {
        $data = [];
        $cart_data = [];
        $grand_total = 0;
        $o_cart = [];

        if($req->session()->has('user_id'))
        {
            $userid = $req->session()->get('user_id');
            $old = (array) DB::table('user_accounts')
                ->join('user_carts','user_accounts._id', '=', 'user_carts._id')
                ->where('user_accounts._id', $userid)
                ->select('user_carts._cart', 'user_carts._cart_id')
                ->first();
            if($old){
                $o_cart = json_decode($old['_cart'], true);
                $req->session()->put('user_cart', $o_cart);
            }
        }
        else{
            if($req->session()->has('user_cart'))
            {
                $o_cart = $req->session()->get('user_cart');
            }
        }

        if($o_cart){

            foreach($o_cart as $item){
 
                $row = [];
                
                $product = DB::table('products')
                    ->where('_id', $item['product_id'])
                    ->first();
                if($product){
                    $images = json_decode($product->_images);
                    $url = null;
                    if($images)
                    {
                        foreach ($images as $image)
                        {
                            $url = url('assets/img/product/'.$image);
                            break;
                        }
                    }
                    $row = ['pid' => $product->_id, 'image' => $url, 'name' => $product->_name, 'price'=> $product->_price, 'quantity' => $item['quantity']];
                }
                $cart_data[] = $row;
                $grand_total = sprintf("%.2f", ($product->_price * $item['quantity']) + $grand_total);
            }
        }
        $data['cartdata'] = $cart_data;
        $data['grandtotal'] = $grand_total;
        //return $data;
        return view('cart', ['data' => $data]);
    }
	//POST :
    public function addProduct(Request $req)
    {
    	if($req->has('_pid','_q')){
    		$p_id = (int) trim($req->_pid);
    		$p_qty = (int) trim($req->_q);

    		$product = DB::table('products')->where('_id', $p_id)->first();
            // product exist
    		if($product){
 
    			if($p_qty && $p_qty > 0){

    				$cart = [];
                    $old = [];
                    $p_limit = false;
                    $have_ac = false;
                    // check product limit status
                    if($product->_limit){
                        $p_limit = true;
                        if($p_qty > $product->_limit)
                        {
                            return response()->json(['msg' => 'a max quantity reached', 'data' => '', 'status' => 200]);
                        }
                    }

                    if($req->session()->has('user_id'))
                    {
                        $have_ac = true;
                    }

                    if($have_ac)
                    {
                        $userid = $req->session()->get('user_id');
                        $old = (array) DB::table('user_accounts')
                            ->join('user_carts','user_accounts._id', '=', 'user_carts._id')
                            ->where('user_accounts._id', $userid)
                            ->select('user_carts._cart', 'user_carts._cart_id')
                            ->first();
                        if($old){
                            $o_cart = json_decode($old['_cart'], true);
                        }
                    }
                    else{
                        if($req->session()->has('user_cart'))
                        {
                            $o_cart = $req->session()->get('user_cart');
                            $old['_cart'] = $o_cart;
                        }
                    }

                    // have saved cart
    				if($old)
    				{
                        // have items in cart
    					if($o_cart)
    					{
    						//$o_cart = json_decode($old['_cart']);//, true);
    						$p_exist = false;

    						foreach($o_cart as $item){

    							if($item['product_id'] == $p_id)
    							{
                                    $p_exist = true;
                                    if($p_limit)
                                    {
                                        if(($item['quantity'] + $p_qty) <= $product->_limit)
                                        {
                                            $item['quantity'] = $item['quantity'] + $p_qty;
                                            $cart[] = $item;
                                        }
                                        else
                                        { 
                                            return response()->json(['msg' => 'b max quantity reached', 'data' => '', 'status' => 200]);
                                        }
                                    }
                                    else
                                    {
                                        $item['quantity'] = $item['quantity'] + $p_qty;
                                        $cart[] = $item;
                                    }                                      
    							}
    							else
    							{
									$cart[] = $item;
    							}
    						}

    						if($p_exist == false){

                                if($p_limit)
                                {
                                    // check max limit
                                    if($p_qty <= $product->_limit)
                                    {
                                        $item = ['product_id' => $p_id, 'quantity' => $p_qty];
                                        $cart[] = $item;
                                    }
                                    else{
                                        return response()->json(['msg' => 'c max quantity reached', 'data' => '', 'status' => 200]);
                                    }
                                }
                                else
                                {
                                    $item = ['product_id' => $p_id, 'quantity' => $p_qty];
                                    $cart[] = $item;
                                }							
    						}

    						$j_cart = json_encode($cart);
                            if($have_ac)
                            {
        						// update existing jcart
        						$result = DB::table('user_carts')
        							->where('_cart_id', $old['_cart_id'])
        							->update(['_cart' => $j_cart]);
                                if(!$result)
                                {
                                    return response()->json(['msg' => 'Something went wrong, try again.', 'data' => '', 'status' => 200]);
                                }
                            }
                            $req->session()->put('user_cart', $cart);
    						return response()->json(['msg' => 'Success.', 'data' => ['_cart' => $cart], 'status' => 200]);
    					}
                        // empty cart
    					else
    					{
                            if($p_limit)
                            {
                                // check max limit
                                if($p_qty <= $product->_limit)
                                {
                                    $item = ['product_id' => $p_id, 'quantity' => $p_qty];
                                    $cart[] = $item;
                                }
                                else{
                                    return response()->json(['msg' => 'd max quantity reached', 'data' => '', 'status' => 200]);
                                }
                            }
                            else
                            {
                                $item = ['product_id' => $p_id, 'quantity' => $p_qty];
                                $cart[] = $item;
                            }
  						
    						$j_cart = json_encode($cart);
                            if($have_ac){
                                // update existing jcart
                                $result = DB::table('user_carts')
                                    ->where('_cart_id', $old['_cart_id'])
                                    ->update(['_cart' => $j_cart]);
                                if(!$result)
                                {
                                    return response()->json(['msg' => 'Something went wrong, try again.', 'data' => '', 'status' => 200]);
                                }
                            }
                            $req->session()->put('user_cart', $cart);
                            return response()->json(['msg' => 'Success.', 'data' => ['_cart' => $cart], 'status' => 200]);
    					}
    				}
                    // have no cart
    				else
    				{
                        if($p_limit)
                        {
                            // check max limit
                            if($p_qty <= $product->_limit)
                            {
                                $item = ['product_id' => $p_id, 'quantity' => $p_qty];
                                $cart[] = $item;
                            }
                            else{
                                return response()->json(['msg' => 'e max quantity reached', 'data' => '', 'status' => 200]);
                            }
                        }
                        else
                        {
                            $item = ['product_id' => $p_id, 'quantity' => $p_qty];
                            $cart[] = $item;
                        }
    					
    					$j_cart = json_encode($cart);
                        if($have_ac){
                            // insert jcart
                            $result = DB::table('user_carts')
                                ->insert(['_id' => $userid, '_cart' => $j_cart]);
                            if(!$result)
                            {
                                return response()->json(['msg' => 'Something went wrong, try again.', 'data' => '', 'status' => 200]);
                            }
                        }
                        $req->session()->put('user_cart', $cart);
                        return response()->json(['msg' => 'Success.', 'data' => ['_cart' => $cart], 'status' => 200]);
    				}
    			}
    			else{
    				return response()->json(['msg' => 'Invalid quantity.', 'data' => '', 'status' => 200]);
    			}
    		}
    		else{
                return response()->json(['msg' => 'Product doesn\'t exist.', 'data' => '', 'status' => 200]);
    		}
    	}
    	else{
    		return response()->json(['msg' => 'Required parameter missing or invalid.', 'data' => '', 'status' => 400], 400);
    	}
    }

    //POST :
    public function removeProduct(Request $req)
    {
    }
}
