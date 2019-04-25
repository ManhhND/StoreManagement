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

use App\Product;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('layouts/master');
});
Route::get('/ex', function () {
    return view('welcome');
});
Route::post('/login','SignInController@postLogin');
Route::post('/logout','SignInController@logout');


Route::middleware('jwt.refresh')->get('/refresh', 'SignInController@refresh');
Route::group(['middleware'=>'jwt.auth'], function(){

    Route::get('/products','ProductsController@getAllProduct');
    Route::get('/types','ProductTypesController@getAllType');
    Route::get('/customers','CustomersController@getAllCustomer');
    Route::get('/vendors','VendorsController@getAllVendor');
    Route::get('/users','UsersController@getUsers');
    Route::get('/userInfo','SignInController@getUserInfo');
    Route::get('/invoices','InvoicesController@getAllInvoice');
});

Route::post('/addProduct','ProductsController@addProduct');
Route::post('/editProduct','ProductsController@editProduct');
Route::get('/editingProduct/{id}','ProductsController@editingProduct');
Route::post('/deleteProduct/{id}','ProductsController@deleteProduct');

Route::post('/addType','ProductTypesController@addType');
Route::post('/editType','ProductTypesController@editType');
Route::get('/editingType/{id}','ProductTypesController@editingType');
Route::post('/deleteType/{id}','ProductTypesController@deleteType');

Route::post('/addCustomer','CustomersController@addCustomer');
Route::post('/editCustomer','CustomersController@editCustomer');
Route::get('/editingCustomer/{id}','CustomersController@editingCustomer');
Route::get('lastestCustomer','CustomersController@getLastestCustomer');
Route::post('/deleteCustomer/{id}','CustomersController@deleteCustomer');

Route::post('/addVendor','VendorsController@addVendor');
Route::post('/editVendor','VendorsController@editVendor');
Route::get('/editingVendor/{id}','VendorsController@editingVendor');
Route::post('/deleteVendor/{id}','VendorsController@deleteVendor');

Route::post('/addUser','UsersController@addUser');
Route::post('/editUser','UsersController@editUser');
Route::get('/editingUser/{id}','UsersController@editingUser');
Route::post('/deleteUser/{id}','UsersController@deleteUser');

Route::post('addInvoice','InvoicesController@addInvoice');
Route::get('getCurrentInvoiceID','InvoicesController@getCurrentInvoiceID');
Route::post('addInvoiceDetail','InvoicesController@addInvoiceDetail');
Route::post('updateQtyDetail','InvoicesController@updateQtyDetail');

Route::post('/search', 'ProductsController@search');
Route::post('/searchCustomer', 'CustomersController@searchCustomer');
// window.axios.defaults.headers.common['Authorization'] = 'Bearer' + localStorage.getItem('token');



