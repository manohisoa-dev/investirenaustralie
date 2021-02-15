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
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Support\Facades\Storage;
/* ---------- ROUTE V2 ------------------*/
Route::prefix('admin')->namespace('Admin')->as('admin.')->middleware(["auth","role:1"])->group(function(){
    Route::get('/', 'AdminController@dashboard')->name('dashboard');
    //profil

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('info', 'ProfileController@editProfile')->name('profile.info');
    Route::post('update', 'ProfileController@updateLocation')->name('location.edit');
    Route::post('password', 'ProfileController@updatePassword')->name('password');

    Route::resource('country','CountryController');
    Route::resource('state','StateController');

    Route::resource('category','CategoryController');

    Route::resource('pub','PubController');
    Route::resource('badword','BadwordController');
    Route::resource('postalcode','PostalcodeController');
    Route::resource('plan','PlanController');
    Route::resource('type','TypeController');
    Route::resource('page','PageController');
    Route::resource('mail','MailController');
    Route::resource('product','ProductController');
    Route::get('archive/{product}', 'ProductController@archive')->name('product.archive');
    Route::get('trash/{product}', 'ProductController@trash')->name('product.trash');
    Route::get('restore/{product}', 'ProductController@restore')->name('product.restore');
    Route::get('publish/{product}', 'ProductController@publish')->name('product.publish');

    Route::resource('blog','BlogController');
    Route::get('archive_blog/{blog}', 'BlogController@archive')->name('blog.archive');

    Route::resource('user','UserController');
    Route::get('desactiver/{user}', 'UserController@desactiver')->name('user.desactiver');
    Route::get('show/{user}', 'UserController@show')->name('user.show');

    Route::resource('sale','SaleController');
    Route::get('pay/{sale}/{role}', 'SaleController@pay')->name('sale.pay');
    Route::resource('role','RoleController');
    Route::resource('type-user','TypeUserController');

    // Confi Controller
    Route::prefix('config')->as('config.')->group(function () {
        Route::get('site', 'ConfigController@site')->name('site');
        Route::post('site', 'ConfigController@site')->name('site.update');
        Route::get('login', 'ConfigController@login')->name('login');
        Route::post('login', 'ConfigController@login')->name('login.update');
        Route::get('social', 'ConfigController@social')->name('social');
        Route::post('social', 'ConfigController@social')->name('social.update');
        Route::get('payment', 'ConfigController@payment')->name('payment');
        Route::post('payment', 'ConfigController@payment')->name('payment.update');
        Route::get('fontawesome', 'ConfigController@fontawesome')->name('fontawesome');
    });
});
