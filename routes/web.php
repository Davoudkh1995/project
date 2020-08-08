<?php

use Illuminate\Support\Facades\Auth;
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

Route::prefix('admin')->namespace('admin')->group(function (){
    Route::resource('/menu','MenuController');
    Route::resource('/slider','SliderController');
    Route::resource('/article','ArticleController');
    Route::resource('/service','ServiceController');
    Route::resource('/portfolio','PortfolioController');
    Route::resource('/contactus','ContactusController');
    Route::resource('/aboutus','AboutusController');
    Route::resource('/socialmedia','SocialmediaController');
    Route::resource('/category_article','CategoryArticleController');
    Route::resource('/category_service','CategoryServiceController');
    Route::resource('/category_portfolio','CategoryPortfolioController');
    Route::post('/page_creator','MenuController@pageCreator');
    Route::post('/slider/file-upload','SliderController@file_upload');
    Route::post('/getSocialmediaItem','SocialmediaController@getSocialmediaItem');
    Route::post('/saveSocialChange','SocialmediaController@saveSocialChange');
    Route::post('/changeSocialStatus','SocialmediaController@changeSocialStatus');
});
/*front routes*/
Route::namespace('front')->group(function (){
    Route::resource('/message','MessageController');
    Route::post('/saveAnswer','MessageController@saveAnswer');
    Route::get('/','MainController@index');
    Route::get('contact_us','MainController@contact');
    Route::get('about_us','MainController@about');
    Route::get('portfolio/{slug}','MainController@portfolioDetails');
    Route::get('portfolio','MainController@portfolios');
    Route::get('article/{slug}','MainController@articleDetails');
    Route::get('beforeArticle/{article_id}','MainController@beforeArticle');
    Route::get('afterArticle/{article_id}','MainController@afterArticle');
    Route::get('article','MainController@articles');
    Route::get('category_archive/{slug}','MainController@articleCategoryArchive');
    Route::post('art_search','MainController@articlesSearch');

});
Route::get('/site/{slug}','admin\MenuController@front_page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
