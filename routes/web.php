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

Route::prefix('admin')->namespace('admin')->group(function () {
    Route::resource('/menu', 'MenuController');
    Route::resource('/slider', 'SliderController');
    Route::resource('/article', 'ArticleController');
    Route::resource('/service', 'ServiceController');
    Route::resource('/portfolio', 'PortfolioController');
    Route::resource('/contactus', 'ContactusController');
    Route::get('/updateContactEn', 'ContactusController@showUpdateContactEn');
    Route::post('/updateContactEn', 'ContactusController@updateContactEn');
    Route::resource('/aboutus', 'AboutusController');
    Route::get('/updateAboutEn', 'AboutusController@showUpdateAboutEn');
    Route::post('/updateAboutEn', 'AboutusController@updateAboutEn');
    Route::resource('/socialmedia', 'SocialmediaController');
    Route::resource('/category_article', 'CategoryArticleController');
    Route::resource('/category_service', 'CategoryServiceController');
    Route::resource('/category_portfolio', 'CategoryPortfolioController');
    Route::post('/page_creator', 'MenuController@pageCreator');
    Route::post('/slider/file-upload', 'SliderController@file_upload');
    Route::post('/getSocialmediaItem', 'SocialmediaController@getSocialmediaItem');
    Route::post('/saveSocialChange', 'SocialmediaController@saveSocialChange');
    Route::post('/changeSocialStatus', 'SocialmediaController@changeSocialStatus');
    Route::resource('/role', 'RoleController');
    Route::resource('/permission', 'PermissionController');
    Route::resource('/admin', 'UserController');
    Route::post('/cat_art_remove_all', 'CategoryArticleController@remove_all')->name('multiRemoveCatArt');
    Route::post('/art_remove_all', 'ArticleController@remove_all')->name('multiRemoveArt');
    Route::post('/menu_remove_all', 'MenuController@remove_all')->name('multiRemoveMenu');
    Route::post('/permission_remove_all', 'PermissionController@remove_all')->name('multiRemovePermission');
    Route::post('/cat_por_remove_all', 'CategoryPortfolioController@remove_all')->name('multiRemoveCatPor');
    Route::post('/por_remove_all', 'PortfolioController@remove_all')->name('multiRemovePor');
    Route::post('/role_remove_all', 'RoleController@remove_all')->name('multiRemoveRole');
    Route::post('/cat_ser_remove_all', 'CategoryServiceController@remove_all')->name('multiRemoveCatSer');
    Route::post('/ser_remove_all', 'ServiceController@remove_all')->name('multiRemoveSer');
    Route::post('/slider_remove_all', 'SliderController@remove_all')->name('multiRemoveSlider');
    Route::post('/admin_remove_all', 'UserController@remove_all')->name('multiRemoveAdmin');

    Route::patch('save_seo_about', 'AboutusController@save_seo_about')->name('save_seo_about');
    Route::patch('save_seo_aboutEn', 'AboutusController@save_seo_aboutEn')->name('save_seo_aboutEn');
    Route::patch('save_seo_article_cat', 'CategoryArticleController@save_seo_article_cat')->name('save_seo_article_cat');
    Route::patch('save_seo_article', 'ArticleController@save_seo_article')->name('save_seo_article');
    Route::patch('save_seo_portfolio_cat', 'CategoryPortfolioController@save_seo_portfolio_cat')->name('save_seo_portfolio_cat');
    Route::patch('save_seo_portfolio', 'PortfolioController@save_seo_portfolio')->name('save_seo_portfolio');
    Route::patch('save_seo_service_cat', 'CategoryServiceController@save_seo_service_cat')->name('save_seo_service_cat');
    Route::patch('save_seo_service', 'ServiceController@save_seo_service')->name('save_seo_service');
    Route::patch('save_seo_menu', 'MenuController@save_seo_menu')->name('save_seo_menu');
    Route::patch('save_seo_contact', 'ContactusController@save_seo_contact')->name('save_seo_contact');
    Route::patch('save_seo_contactEn', 'ContactusController@save_seo_contactEn')->name('save_seo_contactEn');
});
/*front routes*/
Route::namespace('front')->group(function () {
    Route::resource('/message', 'MessageController');
    Route::post('/saveAnswer', 'MessageController@saveAnswer');
    Route::get('/', 'MainController@index');
    Route::get('contact_us', 'MainController@contact');
    Route::get('about_us', 'MainController@about');
    Route::get('portfolio/{slug}', 'MainController@portfolioDetails');
    Route::get('portfolio', 'MainController@portfolios');
//    Route::get("/".session()->get('lang')."/article/{slug}",'MainController@articleDetails');
    Route::get("/article/{slug}", 'MainController@articleDetails');
    Route::get('beforeArticle/{article_id}', 'MainController@beforeArticle');
    Route::get('afterArticle/{article_id}', 'MainController@afterArticle');
    Route::get('article', 'MainController@articles');
    Route::get('category_archive/{slug}', 'MainController@articleCategoryArchive');
    Route::post('art_search', 'MainController@articlesSearch');

});
Route::get('/changeLanguage/{lang}', 'front\MainController@changeLanguage');
Route::get('/site/{slug}', 'admin\MenuController@front_page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
