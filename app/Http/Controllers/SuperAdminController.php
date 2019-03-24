<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class SuperAdminController extends Controller
{
    public function adminAuthCheck()
    {
    	$admin_id=Session::get('admin_id');
    	if($admin_id)
    	{
    		return view('admin.dashboard');
    	}
    	else
    	{
    		return Redirect::to('/admin');
    	}
    }

    public function logout()
    {
    	//Session::put('admin_name',null);
    	//Session::put('admin_id',null);
    	Session::flush();
    	return Redirect::to('/admin');
    }
}
