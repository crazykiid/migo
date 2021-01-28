<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function viewProduct($id)
    {
		//DB::table('products')->whereRaw('DAY(_reg_at) = '.$day)->count();

		if(strlen($id) > 0)
		{
			try
			{
				$product = DB::table('products')
					->where('_id', $id)
					->first();
				if($product)
				{
					//$data['cart'] = CartController::getCartCount();
					$data['id'] = $product->_id;
					$data['name'] = $product->_name;
					$data['description'] = $product->_description;
					$data['price'] = $product->_price;
					$data['images'] = [];
					$data['limit'] = $product->_limit;

					$images = json_decode($product->_images);
					$urls = [];
					if($images){
						foreach ($images as $image){
							$url = url('assets/img/product/'.$image);
							$urls[] = $url;
						}
					}
					$data['images'] = $urls;
					//return $data;
					return view('products.view', ['data' => $data]);
				}
				else
				{
					return "Product Doesn't Exist.";
				}
			}
			catch(\Exception $e)
			{
				return "Error Occurred.";
			}
		}
        else
        {
        	return "Invalid Product.";
        }
    }
    public function pickProduct(Request $req){

    }
    public function dropProduct(Request $req){

    }
}
