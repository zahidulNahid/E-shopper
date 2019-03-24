<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class SliderController extends Controller
{
    public function index()
    {
    	return view('admin.add_slider');
    }

    public function save_slider(Request $request)
    {
    	$data=array();
    	$data['publication_status']=$request->publication_status;
    	$image=$request->file('slider_image');

    	if($image)
    	{
    		$image_name=str_random(20);
    		$ext=strtolower($image->getClientOriginalExtension());
    		$image_full_name=$image_name.'.'.$ext;
    		$upload_path='slider/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if($success)
    		{
    			$data['slider_image']=$image_url;

    			DB::table('tbl_slider')->insert($data);
    	        Session::put('message','slider added');
    	        return Redirect('/add-slider');
    		}
    	}
    	$data['slider_image']='';

    			DB::table('tbl_slider')->insert($data);
    	        Session::put('message','slider added without image');
    	        return Redirect('/add-slider');
    }

    public function all_slider()
    {
    	$all_slider_info['all_slider_info']=DB::table('tbl_slider')->get();

    	if(count($all_slider_info)>0)
    	{
    		return view('admin.all_slider',$all_slider_info);
    	}
    	else
    	{
    		return view('admin.all_slider');
    	}
    }

    public function unactive_slider($sli_id)
    {
    	DB::table('tbl_slider')
    	->where('slider_id',$sli_id)
    	->update(['publication_status'=>0]);
    	Session::put('message','slider unactivated');
    	return Redirect::to('/all-slider');
    }

    public function active_slider($sli_id)
    {
    	DB::table('tbl_slider')
    	->where('slider_id',$sli_id)
    	->update(['publication_status'=>1]);
    	Session::put('message','slider activated');
    	return Redirect::to('/all-slider');
    }

    public function delete_slider($sli_id)
    {
    	DB::table('tbl_slider')
    	->where('slider_id',$sli_id)
    	->delete();
    	Session::put('message','slider deleted');
    	return Redirect('/all-slider');
    }

}
