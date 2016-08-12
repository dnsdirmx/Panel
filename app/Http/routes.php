<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('admin-login', 'AdminAuth\AuthController@adminLogin');
    Route::post('admin-login', ['as'=>'admin-login','uses'=>'AdminAuth\AuthController@adminLoginPost']);
     
    Route::get('embajador-login', 'Auth\AuthController@embajadorLogin');
    Route::post('embajador-login', ['as'=>'embajador-login','uses'=>'Auth\AuthController@embajadorLoginPost']);
    

    //Rutas empresa
    Route::get('empresa-login', 'EmpresaAuth\AuthController@empresaLogin');
    Route::post('empresa-login', ['as'=>'empresa-login','uses'=>'EmpresaAuth\AuthController@empresaLoginPost']);
    
    
    Route::get('empresa-register','EmpresaAuth\AuthController@showRegistrationForm');
    Route::post('empresa-register','EmpresaAuth\AuthController@register');
    
    Route::get('empresa/logout', ['middleware' => 'auth:empresa','uses' => 'EmpresaAuth\AuthController@logout']);
    Route::get('empresa', ['middleware' => 'auth:empresa','uses' => 'EmpresaController@index']);
    
});
