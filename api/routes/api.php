<?php

    use Illuminate\Http\Request;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */
    Route::resource('clients', 'Api\ClientsController');
    Route::get('clients/{id}/products', 'Api\ClientsController@clientsProducts');
    Route::resource('products', 'Api\ProductsController');
    Route::get('products/{id}/clients', 'Api\ProductsController@productsClients');
    Route::resource('sales', 'Api\SalesController');
    Route::delete('sales/{client_id}/{product_id}','Api\SalesController@destroy');
