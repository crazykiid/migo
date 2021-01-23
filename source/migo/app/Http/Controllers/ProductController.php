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
			$result = DB::table('products')->where('_id', $id)->first();

			$data['id'] = $result->_id;
			$data['name'] = $result->_name;
			$data['description'] = $result->_description;
			$data['price'] = $result->_price;
			$data['images'] = [];
			$images = json_decode($result->_images, true);
			if($images && count($images) > 0){
				foreach ($images as $img) {
					$data['images'][] = 'http://localhost:8000/assets/img/product/'.$img;
				}
			}
			$data['max'] = 4;
			return view('products.view', ['data' => $data]);
		}
        else{
        	return "invalid product";
        }
    }
    public function pickProduct(Request $req){

    }
    public function dropProduct(Request $req){

    }
}
