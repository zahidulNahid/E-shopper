<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class CategoryController extends Controller
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
    	return view('admin.add_category');
    }

    public function all_category()
    {
        $this->adminAuthCheck();
    	$all_category_info['all_category_info']=DB::table('tbl_category')->get();

    	if(count($all_category_info)>0)
    	{
    		return view('admin.all_category',$all_category_info);
    	}
    	else
    	{
    		return view('admin.all_category');
    	}
    }

    public function save_category(Request $request)
    {
    	$data=array();
    	$data['category_id']=$request->category_id;
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$data['publication_status']=$request->publication_status;

    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Category added');
    	return Redirect('/add-category');
    	
    }

    public function unactive_category($cat_id)
    {
    	DB::table('tbl_category')
    	->where('category_id',$cat_id)
    	->update(['publication_status'=>0]);
    	Session::put('message','Category unactivated');
    	return Redirect::to('/all-category');
    }

    public function active_category($cat_id)
    {
    	DB::table('tbl_category')
    	->where('category_id',$cat_id)
    	->update(['publication_status'=>1]);
    	Session::put('message','Category activated');
    	return Redirect::to('/all-category');
    }

    public function edit_category($cat_id)
    {
    	$category_info['category_info']=DB::table('tbl_category')->where('category_id',$cat_id)->first();
    	return view('admin.edit_category',$category_info);
    }

    public function update_category(Request $request,$cat_id)
    {
    	$data=array();
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;

    	DB::table('tbl_category')
    	->where('category_id',$cat_id)
    	->update($data);
    	Session::put('message','Category Updated');
    	return Redirect('/all-category');
    }

    public function delete_category($cat_id)
    {
    	DB::table('tbl_category')
    	->where('category_id',$cat_id)
    	->delete();
    	Session::put('message','Category deleted');
    	return Redirect('/all-category');
    }
}
