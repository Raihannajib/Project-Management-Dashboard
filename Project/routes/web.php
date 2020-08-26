<?php

use Illuminate\Support\Facades\Route;

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


//Api-GET
Route::get('/sales','SaleController@get')->name('get_sales');
Route::get('/countries','SaleController@getCountries')->name('get_countries');
Route::get('/country_data','CountryController@countriesData')->name('countries');
Route::get('/api_data','SaleController@allApiAdmin')->name('api_get');
Route::get('season_data','SaleController@seasonData');
Route::get('admin/get_post_chart_data', 'SaleController@getChartData');

//test pyspark
//not working yet
Route::get('admin/pyspark', 'SaleController@pysparkService');



//Admin_dashboard
Route::group(['middleware' => 'auth'],function () {
    Route::get('/admin', 'SaleController@getStatistic');
    Route::get('admin/manage_sales', 'SaleController@manageSales');
    Route::post('admin/select_region', 'SaleController@regionSales');

    Route::get('sales_prediction', 'SaleController@seasonChart');;

    Route::get('admin/order_date_region', 'SaleController@getOrdersDateAndRegion');
    Route::get('admin/gain_lost','SaleController@GainLostVariation');


    Route::get('admin/map', 'SaleController@getMap');
    Route::get('/logout', 'SaleController@logout');

});

//Authentication
Auth::routes();
