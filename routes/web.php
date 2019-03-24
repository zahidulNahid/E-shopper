<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend site
Route::get('/','HomeController@index');
//product by category
Route::get('/product_by_category/{cat_id}','HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{man_id}','HomeController@show_product_by_manufacture');
Route::get('/view_product/{pro_id}','HomeController@product_details_by_id');
//cart
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
Route::post('/update-cart','CartController@update_cart');

//checkout
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping','CheckoutController@save_shipping');

//customer login logout
Route::post('/customer_login','CheckoutController@customer_login');
Route::get('/customer_logout','CheckoutController@customer_logout');

Route::get('/payment','CheckoutController@payment');
Route::post('/order_place','CheckoutController@order_place');


//backend site
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/dashboard','SuperAdminController@adminAuthCheck');
Route::post('/admin-dashboard','AdminController@dashboard');

//category
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/unactive_category/{cat_id}','CategoryController@unactive_category');
Route::get('/active_category/{cat_id}','CategoryController@active_category');
Route::get('/edit-category/{cat_id}','CategoryController@edit_category');
Route::post('/update-category/{cat_id}','CategoryController@update_category');
Route::get('/delete-category/{cat_id}','CategoryController@delete_category');

//Manufacture or Brand
Route::get('/add-manufacture','ManufactureController@index');
Route::post('/save-manufacture','ManufactureController@save_manufacture');
Route::get('/all-manufacture','ManufactureController@all_manufacture');
Route::get('/unactive_manufacture/{man_id}','ManufactureController@unactive_manufacture');
Route::get('/active_manufacture/{man_id}','ManufactureController@active_manufacture');
Route::get('/edit-manufacture/{man_id}','ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{man_id}','ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{man_id}','ManufactureController@delete_manufacture');

//products
Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/unactive_product/{pro_id}','ProductController@unactive_product');
Route::get('/active_product/{pro_id}','ProductController@active_product');
Route::get('/delete-product/{pro_id}','ProductController@delete_product');

//slider
Route::get('/add-slider','SliderController@index');
Route::post('/save-slider','SliderController@save_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/unactive_slider/{sli_id}','SliderController@unactive_slider');
Route::get('/active_slider/{sli_id}','SliderController@active_slider');
Route::get('/delete-slider/{sli_id}','SliderController@delete_slider');

//order
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{order_id}','CheckoutController@view_order');