<?php

use Illuminate\Support\Facades\Route;

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

Route::get('pwc/companies', 'Api\CompanyController@search');
Route::get('pwc/sublos', 'Api\SublosController@fetch')->name('api_sublos');
Route::get('pwc/legacy', 'Api\LegacyController@all');
Route::get('pwc/office', 'Api\OfficeController@all');
Route::get('pwc/los', 'Api\LosController@all');
