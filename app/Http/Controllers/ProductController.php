<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class ProductController extends Controller
{
	public function adminAuthCheck()
    {
        $admin_id=Session::get('admin_id');
        if($admin_id)
        {
            return;
        }
        else
        {
            return Redirect::to('/admin')->send();
        }
    }

    public function index()
    {
    	$this->adminAuthCheck();

    	return view('admin.add_product');
    }

    public function all_product()
    {
    	$this->adminAuthCheck();
    	$all_product_info['all_product_info']=DB::table('tbl_products')
    	                                     ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    	                                     ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    	                                     ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    	                                     ->get();

    	if(count($all_product_info)>0)
    	{
    		return view('admin.all_product',$all_product_info);
    	}
    	else
    	{
    		return view('admin.all_product');
    	}
    }

    public function save_product(Request $request)
    {
    	$data=array();
    	$data['product_name']=$request->product_name;
    	$data['category_id']=$request->category_id;
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['product_short_description']=$request->product_short_description;
    	$data['product_long_description']=$request->product_long_description;
    	$data['product_price']=$request->product_price;
    	$data['product_size']=$request->product_size;
    	$data['product_color']=$request->product_color;
    	$data['publication_status']=$request->publication_status;
    	$image=$request->file('product_image');

    	if($image)
    	{
    		$image_name=str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name=$image_name.'.'.$ext;
    		$upload_path='image/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['product_image']=$image_url;

    			DB::table('tbl_products')->insert($data);
    	        Session::put('message','product added');
    	        return Redirect('/add-product');
    		}
    	}
    	$data['product_image']='';

    			DB::table('tbl_products')->insert($data);
    	        Session::put('message','product added without image');
    	        return Redirect('/add-product');
    }

    public function unactive_product($pro_id)
    {
    	DB::table('tbl_products')
    	->where('product_id',$pro_id)
    	->update(['publication_status'=>0]);
    	Session::put('message','product unactivated');
    	return Redirect::to('/all-product');
    }

    public function active_product($pro_id)
    {
    	DB::table('tbl_products')
    	->where('product_id',$pro_id)
    	->update(['publication_status'=>1]);
    	Session::put('message','product activated');
    	return Redirect::to('/all-product');
    }

    public function delete_product($pro_id)
    {
    	DB::table('tbl_products')
    	->where('product_id',$pro_id)
    	->delete();
    	Session::put('message','product deleted');
    	return Redirect('/all-product');
    }
}
