<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PageController extends Controller
{
    public function index()
    {
    	$data = [];
    	$product_list = [];
    	$products = DB::table('products')
    		->select('_id', '_name', '_price', '_images')
    		->where('_status', 1)
    		->get();
    	if($products)
    	{
    		foreach($products as $product)
    		{
	    		$images = json_decode($product->_images);
	    		$url = null;
	    		if($images)
	    		{
	    			foreach($images as $image)
	    			{
	    				$url = url('assets/img/product/'.$image);
	    				break;
	    			}
	    		}
	    		$product_list[] = ['pid' => $product->_id, 'name' => $product->_name, 'price' => $product->_price, 'image' => $url];
    		}
    	}
    	$data['product_list'] = $product_list;
    	//return $data;
    	return view('index', ['data' => $data]);
    }
}
