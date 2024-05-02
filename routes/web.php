<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


    


Route::get("/",function(){
    return "working";
});

Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'inova'] , function(){
    Route::get('/', 'mainController@home')->name('home');
    
    // Route::get('inoje', 'projectController@inojeIndex')->name('inoje');
    
    
    
    // Route::get('/inovents' , ['uses' => 'MainController@main'])->name('inovents');
    // Route::get('/' , ['uses' => 'MainController@main']);
    // Route::match(['get' , 'post'] , '/match' , ['uses' => 'MainController@main']);
    // Route::group(['prefix' => 'inolearn'] , function() {
    //     Route::get('/' , ['uses' => 'MainController@main'])->name('inovents');
    //     Route::get('/blog' , ['uses' => 'MainController@main'])->name('blog-blog');
    //     Route::get('/forum' , ['uses' => 'MainController@main'])->name('forum-forum');
    // });
});

Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'inoje_inova'] , function(){
    Route::get('/', 'inojeController@landing')->name('inoje-landing');
    Route::get('/index', 'inojeController@index')->name('inoje-index');
    Route::get('/{slug}', 'inojeController@show')->name('inoje-show');
});
Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'inovent_inova'] , function(){
    Route::get('/', 'inoventController@landing')->name('inovent-landing');
    Route::get('/{slug}', 'inoventController@show')->name('inovent-show');
});
Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'inojob_inova'] , function(){
    Route::get('/', 'inojobController@landing')->name('inojob-landing');
    Route::get('/index', 'inojobController@index')->name('inojob-index');
    Route::get('/{slug}', 'inojobController@show')->name('inojob-show');
});
Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'inothes_inova'] , function(){
    Route::get('/', 'mainController@landing')->name('inothes-landing');
    Route::get('/index', 'inothesController@index')->name('inothes-index');
    Route::get('/{slug}', 'inothesController@show')->name('inothes-show');
});
Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'inolearn_inova'] , function(){
    Route::get('/', 'mainController@landing')->name('inolearn-landing');
    Route::get('/index', 'inolearnController@index')->name('inolearn-index');
    Route::get('/{slug}', 'inolearnController@show')->name('inolearn-show');
});
Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'community_inova'] , function(){
    Route::get('/', 'mainController@landing')->name('community-landing');
    Route::get('/index', 'communityController@index')->name('community-index');
    Route::get('/{slug}', 'communityController@show')->name('community-show');
});
Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'help_inova'] , function(){
    Route::get('/', 'mainController@landing')->name('help-landing');
    Route::get('/index', 'helpController@index')->name('help-index');
    Route::get('/{slug}', 'helpController@show')->name('help-show');
});
Route::group(['namespace' => 'App\Http\Controllers\Website' , 'prefix' => '/' , 'domain' => 'support_inova'] , function(){
    Route::get('/', 'mainController@landing')->name('support-landing');
    Route::get('/index', 'supportController@index')->name('support-index');
    Route::get('/{slug}', 'supportController@show')->name('support-show');
});