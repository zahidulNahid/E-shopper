<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class HomeController extends Controller
{
    public function index()
    {
    	$all_published_product['all_published_product']=DB::table('tbl_products')
    	                                     ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
    	                                     ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
    	                                     ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
    	                                     ->where('tbl_products.publication_status',1)
    	                                     ->limit(6)
    	                                     ->get();

    	if(count($all_published_product)>0)
    	{
    		return view('pages.home_content',$all_published_product);
    	}
    	else
    	{
    		return view('pages.home_content');
    	}
    }

    public function show_product_by_category($cat_id)
    {
        $all_published_product_by_category['all_published_product_by_category']=DB::table('tbl_products')
                                             ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                                             ->select('tbl_products.*','tbl_category.category_name')
                                             ->where('tbl_products.category_id',$cat_id)
                                             ->where('tbl_products.publication_status',1)
                                             ->limit(6)
                                             ->get();

        if(count($all_published_product_by_category)>0)
        {
            return view('pages.products_by_category',$all_published_product_by_category);
        }
        else
        {
            return view('pages.products_by_category');
        }
    }

    public function show_product_by_manufacture($man_id)
    {
        $all_published_product_by_manufacture['all_published_product_by_manufacture']=DB::table('tbl_products')
                                             ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                                             ->select('tbl_products.*','tbl_manufacture.manufacture_name')
                                             ->where('tbl_products.manufacture_id',$man_id)
                                             ->where('tbl_products.publication_status',1)
                                             ->limit(6)
                                             ->get();

        if(count($all_published_product_by_manufacture)>0)
        {
            return view('pages.products_by_manufacture',$all_published_product_by_manufacture);
        }
        else
        {
            return view('pages.products_by_manufacture');
        }
    }

    public function product_details_by_id($pro_id)
    {
        $product_details['product_details']=DB::table('tbl_products')
                                             ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                                             ->join('tbl_manufacture','tbl_products.manufacture_id','=','tbl_manufacture.manufacture_id')
                                             ->select('tbl_products.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                                             ->where('tbl_products.product_id',$pro_id)
                                             ->where('tbl_products.publication_status',1)
                                             ->limit(6)
                                             ->first();

        if(count($product_details)>0)
        {
            return view('pages.product_details',$product_details);
        }
        else
        {
            return view('pages.product_details');
        }
    }
}
