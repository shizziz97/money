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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

//admin
Route::resource('/admin/users', 'UserController', ['middleware' => ['auth', 'admin']]);
Route::resource('/admin/admins', 'AdminController', ['middleware' => ['auth', 'admin']]);
Route::resource('/admin/categories','CategoryController',['middleware'=>['auth','admin']])->except('create','show');
Route::get('/admin/items/search','ItemController@search',['middleware'=>['auth','admin']])->name('items.search');
Route::resource('/admin/items', 'ItemController', ['middleware' => ['auth', 'admin']]);
Route::resource('/admin/sizes','SizeController',['middleware'=>['auth','admin']])->except('create','show');
Route::get('/admin/itemthing/addsale/{id}','ItemthingController@getaddsale',['middleware'=>['auth','admin']])->name('itemthing.getaddsale');
Route::post('/admin/itemthing/addsale/{item}','ItemthingController@postaddsale',['middleware'=>['auth','admin']])->name('itemthing.postaddsale');

Route::get('/admin/itemthing/editsize/{id}','ItemthingController@geteditsize',['middleware'=>['auth','admin']])->name('itemthing.geteditsize');
Route::post('/admin/itemthing/editsize/{item}','ItemthingController@posteditsize',['middleware'=>['auth','admin']])->name('itemthing.posteditsize');

Route::get('/admin/itemthing/removesale/{id}','ItemthingController@removesale',['middleware'=>['auth','admin']])->name('itemthing.removesale');
//any guest 
Route::get('/shopping/home/userprofile','HomeShoppingController@profile')->name('home.profile');
Route::get('/shopping/home/userorder','HomeShoppingController@userOrder')->name('home.userOrder');
Route::get('/shopping/home/seephoto/{photo}','HomeShoppingController@seephoto')->name('home.seephoto');
Route::get('/shopping/home/order/{id}','HomeShoppingController@createOrder')->name('home.order');
Route::resource('/Shopping/home','HomeShoppingController')->except('create');
//ordering (admin)
Route::get('/shop/order/acceptable','OrderController@acceptable',['middleware'=>['auth','admin']])->name('order.acceptable');
Route::get('/shop/order/Done/{id}','OrderController@Done' ,['middleware'=>['auth','admin']])->name('order.Done');
Route::get('/shop/order/accept/{id}','OrderController@accept' ,['middleware'=>['auth','admin']])->name('order.accept');
Route::resource('/shop/order','OrderController',['middleware'=>['auth','admin']])->except('create','store','edit','update');
Route::get('/home', 'HomeController@index')->name('home');
