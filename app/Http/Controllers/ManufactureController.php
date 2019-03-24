<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class ManufactureController extends Controller
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
    	return view('admin.add_manufacture');
    }

    public function save_manufacture(Request $request)
    {
    	$data=array();
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;
    	$data['publication_status']=$request->publication_status;

    	DB::table('tbl_manufacture')->insert($data);
    	Session::put('message','Manufacture added');
    	return Redirect('/add-manufacture');
    }

    public function all_manufacture()
    {
        $this->adminAuthCheck();
    	$all_manufacture_info['all_manufacture_info']=DB::table('tbl_manufacture')->get();

    	if(count($all_manufacture_info)>0)
    	{
    		return view('admin.all_manufacture',$all_manufacture_info);
    	}
    	else
    	{
    		return view('admin.all_manufacture');
    	}
    }

    public function unactive_manufacture($man_id)
    {
    	DB::table('tbl_manufacture')
    	->where('manufacture_id',$man_id)
    	->update(['publication_status'=>0]);
    	Session::put('message','manufacture unactivated');
    	return Redirect::to('/all-manufacture');
    }

    public function active_manufacture($man_id)
    {
    	DB::table('tbl_manufacture')
    	->where('manufacture_id',$man_id)
    	->update(['publication_status'=>1]);
    	Session::put('message','manufacture activated');
    	return Redirect::to('/all-manufacture');
    }

    public function edit_manufacture($man_id)
    {
    	$manufacture_info['manufacture_info']=DB::table('tbl_manufacture')->where('manufacture_id',$man_id)->first();
    	return view('admin.edit_manufacture',$manufacture_info);
    }

    public function update_manufacture(Request $request,$man_id)
    {
    	$data=array();
    	$data['manufacture_name']=$request->manufacture_name;
    	$data['manufacture_description']=$request->manufacture_description;

    	DB::table('tbl_manufacture')
    	->where('manufacture_id',$man_id)
    	->update($data);
    	Session::put('message','manufacture Updated');
    	return Redirect('/all-manufacture');
    }

    public function delete_manufacture($man_id)
    {
    	DB::table('tbl_manufacture')
    	->where('manufacture_id',$man_id)
    	->delete();
    	Session::put('message','manufacture deleted');
    	return Redirect('/all-manufacture');
    }
}
