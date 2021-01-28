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
Route::prefix('V2')->namespace('V2')->as('v2.')->group(function(){
    Route::prefix('admin')->namespace('admin')->as('admin.')->middleware(["auth","role:admin"])->group(function(){
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        //profil
<<<<<<< HEAD
        Route::get('profile', 'ProfileController@index')->name('admin.profile');
        Route::post('info', 'ProfileController@editProfile')->name('admin.profile.info');        
        Route::post('update', 'ProfileController@updateLocation')->name('admin.location.edit');
        Route::post('password', 'ProfileController@updatePassword')->name('admin.password');
=======
        Route::get('profile', 'ProfileController@index')->name('profile');
        Route::post('info', 'ProfileController@editProfile')->name('profile.info');
        Route::post('update', 'ProfileController@updateLocation')->name('location.edit');
>>>>>>> 957cd62c77e87649015c0222355fecdf34dec303
        //user
        Route::get('users/{filter?}', 'UserController@all')->name('user.list');
        Route::get('show/{user}', 'UserController@show')->name('user.show');

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
        Route::resource('blog','BlogController');
    });

    // Config Controller
    Route::prefix('config')->group(function () {
        Route::get('site', 'ConfigController@site')->name('config.site');
        Route::post('site', 'ConfigController@site')->name('config.site.update');
        Route::get('login', 'ConfigController@login')->name('config.login');
        Route::post('login', 'ConfigController@login')->name('config.login.update');
        Route::get('social', 'ConfigController@social')->name('config.social');
        Route::post('social', 'ConfigController@social')->name('config.social.update');
        Route::get('payment', 'ConfigController@payment')->name('config.payment');
        Route::post('payment', 'ConfigController@payment')->name('config.payment.update');
        Route::get('fontawesome', 'ConfigController@fontawesome')->name('config.fontawesome');
    });
});


/* ---------- ROUTE V1 ------------------*/
Route::prefix('admin')->middleware(["auth","role:admin"])->group(function(){

    // User Controller Groups
    Route::get('users/{filter?}', 'UserController@all')->name('admin.user.list');
    Route::prefix('user')->group(function(){
        Route::get('/', 'UserController@create')->name('admin.user.create');
        Route::post('/', 'UserController@store')->name('admin.user.store');
        Route::get('show/{user}', 'UserController@show')->name('admin.user.show');
        Route::post('show/{user}', 'ObservationController@store')->name('admin.user.observe');
        Route::get('update/{user}', 'UserController@edit')->name('admin.user.edit');
        Route::post('update/{user}', 'UserController@update')->name('admin.user.update');

        Route::get('active/{user}', 'UserController@active')->name('admin.user.active');
        Route::get('block/{user}', 'UserController@block')->name('admin.user.block');
        Route::get('disable/{user}', 'UserController@disable')->name('admin.user.disable');

        Route::get('delete/{user}', 'UserController@delete')->name('admin.user.delete');

        Route::get('contact/{user}' , 'UserController@contact')->name('admin.user.contact');
        Route::post('contact/{user}', 'UserController@postContact');
    });

    // Product Controller Groups
    Route::get('products/{filter?}', 'ProductController@all')->name('admin.product.list');
    Route::prefix('product')->group(function(){
        Route::get('show/{product}', 'ProductController@show')->name('admin.product.show');

        Route::get('publish/{product}', 'ProductController@publish')->name('admin.product.publish');
        Route::get('archive/{product}', 'ProductController@archive')->name('admin.product.archive');
        Route::get('trash/{product}', 'ProductController@trash')->name('admin.product.trash');
        Route::get('restore/{product}', 'ProductController@restore')->name('admin.product.restore');

        Route::get('delete/{product}', 'ProductController@delete')->name('admin.product.delete');
    });

    // Sale Controller
    Route::get('sales/{filter?}', 'SaleController@all')->name('admin.sale');
    Route::prefix('sale')->group(function(){
        Route::get('{sale}', 'SaleController@show')->name('admin.sale.show');
        Route::get('pay/{sale}/{role}', 'SaleController@pay')->name('admin.sale.pay');
        Route::post('pay/{sale}/{role}', 'SaleController@postPay');
        Route::get('delete/{sale}', 'SaleController@delete')->name('admin.sale.delete');
    });

    Route::get('/', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/chart/{type}', 'AdminController@chart')->name('admin.chart');

    // Blog Controller Groups
    Route::get('blogs/{filter?}', 'BlogController@allAdmin')->name('admin.blog.list');
    Route::prefix('blog')->group(function(){
        Route::get('/', 'BlogController@create')->name('admin.blog.create');
        Route::post('/', 'BlogController@store')->name('admin.blog.store');
        Route::get('update/{blog}', 'BlogController@edit')->name('admin.blog.edit');
        Route::post('update/{blog}', 'BlogController@update')->name('admin.blog.update');

        Route::get('publish/{blog}', 'BlogController@publish')->name('admin.blog.publish');
        Route::get('archive/{blog}', 'BlogController@archive')->name('admin.blog.archive');
        Route::get('trash/{blog}', 'BlogController@trash')->name('admin.blog.trash');
        Route::get('restore/{blog}', 'BlogController@restore')->name('admin.blog.restore');
        Route::get('star/{blog}', 'BlogController@star')->name('admin.blog.star');
        Route::get('delete/{blog}', 'BlogController@delete')->name('admin.blog.delete');
    });

    // Comment Controller Groups
    Route::get('comments/{blog}/{filter?}', 'CommentController@all')->name('admin.comment.list');
    Route::prefix('comment')->group(function(){
        Route::get('show/{comment}', 'CommentController@show')->name('admin.comment.show');

        Route::get('publish/{comment}', 'CommentController@publish')->name('admin.comment.publish');
        Route::get('archive/{comment}', 'CommentController@archive')->name('admin.comment.archive');
        Route::get('trash/{comment}', 'CommentController@trash')->name('admin.comment.trash');
        Route::get('restore/{comment}', 'CommentController@restore')->name('admin.comment.restore');

        Route::get('delete/{comment}', 'CommentController@delete')->name('admin.comment.delete');
    });

    // Category Controller Groups
    Route::get('categories/{filter?}', 'CategoryController@allAdmin')->name('admin.category.list');
    Route::prefix('category')->group(function(){
        Route::get('/', 'CategoryController@create')->name('admin.category.create');
        Route::post('/', 'CategoryController@store')->name('admin.category.store');
        Route::get('show/{category}', 'CategoryController@show')->name('admin.category.show');
        Route::get('update/{category}', 'CategoryController@edit')->name('admin.category.edit');
        Route::post('update/{category}', 'CategoryController@update')->name('admin.category.update');

        Route::get('delete/{category}', 'CategoryController@delete')->name('admin.category.delete');
    });

    // Plan Controller Groups
    Route::get('plans/{filter?}', 'PlanController@all')->name('admin.plan.list');
    Route::prefix('plan')->group(function(){
        Route::get('/', 'PlanController@create')->name('admin.plan.create');
        Route::post('/', 'PlanController@store')->name('admin.plan.store');
        Route::get('show/{plan}', 'PlanController@show')->name('admin.plan.show');
        Route::get('update/{plan}', 'PlanController@edit')->name('admin.plan.edit');
        Route::post('update/{plan}', 'PlanController@update')->name('admin.plan.update');

        Route::get('delete/{plan}', 'PlanController@delete')->name('admin.plan.delete');
    });

    // Page Controller Groups
    Route::get('pages/{filter?}', 'PageController@allAdmin')->name('admin.page.list');
    Route::prefix('page')->group(function(){
        Route::get('/', 'PageController@create')->name('admin.page.create');
        Route::post('/', 'PageController@store')->name('admin.page.store');
        Route::get('show/{page}', 'PageController@show')->name('admin.page.show');
        Route::get('update/{page}', 'PageController@edit')->name('admin.page.edit');
        Route::post('update/{page}', 'PageController@update')->name('admin.page.update');

        Route::get('delete/{page}', 'PageController@delete')->name('admin.page.delete');
    });

    // Pub Controller Groups
    Route::get('pubs/{filter?}', 'PubController@allAdmin')->name('admin.pub.list');
    Route::prefix('pub')->group(function(){
        Route::get('/', 'PubController@create')->name('admin.pub.create');
        Route::post('/', 'PubController@store')->name('admin.pub.store');
        Route::get('show/{pub}', 'PubController@show')->name('admin.pub.show');
        Route::get('update/{pub}', 'PubController@edit')->name('admin.pub.edit');
        Route::post('update/{pub}', 'PubController@update')->name('admin.pub.update');
        Route::get('detach/{pub}/{page}', 'PubController@detach')->name('admin.pub.detach');

        Route::get('delete/{pub}', 'PubController@delete')->name('admin.pub.delete');
    });

    // Bad Words Controller Groups
    Route::get('badwords', 'BadWordController@all')->name('admin.badword.list');
    Route::prefix('badword')->group(function(){
        Route::get('/', 'BadWordController@create')->name('admin.badword.create');
        Route::post('/', 'BadWordController@store')->name('admin.badword.store');
        Route::get('update/{badword}', 'BadWordController@edit')->name('admin.badword.edit');
        Route::post('update/{badword}', 'BadWordController@update')->name('admin.badword.update');

        Route::get('delete/{badword}', 'BadWordController@delete')->name('admin.badword.delete');
    });

    // Code Postal Controller Groups
    Route::get('postal-codes', 'PostalCodeController@all')->name('admin.postalcode.list');
    Route::prefix('postal-code')->group(function(){
        Route::get('/', 'PostalCodeController@create')->name('admin.postalcode.create');
        Route::post('/', 'PostalCodeController@store')->name('admin.postalcode.store');
        Route::get('update/{postalcode}', 'PostalCodeController@edit')->name('admin.postalcode.edit');
        Route::post('update/{postalcode}', 'PostalCodeController@update')->name('admin.postalcode.update');

        Route::get('delete/{postalcode}', 'PostalCodeController@delete')->name('admin.postalcode.delete');
    });

    // State Controller Groups
    Route::get('states', 'StateController@all')->name('admin.state.list');
    Route::prefix('state')->group(function(){
        Route::get('/', 'StateController@create')->name('admin.state.create');
        Route::post('/', 'StateController@store')->name('admin.state.store');
        Route::get('update/{state}', 'StateController@edit')->name('admin.state.edit');
        Route::post('update/{state}', 'StateController@update')->name('admin.state.update');


        Route::get('delete/{state}', 'StateController@delete')->name('admin.state.delete');
    });

    // Chat Controller Groups
    Route::get('chats/{filter?}', 'ThreadController@all')->name('admin.chat.list');
    Route::prefix('chat')->group(function(){
        Route::get('show/{thread}', 'ThreadController@show')->name('admin.thread.show');

        Route::get('delete/{thread}', 'ThreadController@delete')->name('admin.thread.delete');
    });

    // Observation Controller Groups
    Route::get('observations/{filter?}', 'ObservationController@allAdmin')->name('admin.observation.list');
    Route::prefix('observation')->group(function(){
        Route::get('update/{observation}', 'ObservationController@edit')->name('admin.observation.edit');
        Route::post('update/{observation}', 'ObservationController@update')->name('admin.observation.update');

        Route::get('delete/{observation}', 'ObservationController@delete')->name('admin.observation.delete');
        Route::get('restore/{observation}', 'ObservationController@restore')->name('admin.observation.restore');
    });

    // Config Controller
    Route::prefix('config')->group(function () {
        Route::get('site', 'ConfigController@site')->name('config.site');
        Route::post('site', 'ConfigController@site')->name('config.site.update');
        Route::get('login', 'ConfigController@login')->name('config.login');
        Route::post('login', 'ConfigController@login')->name('config.login.update');
        Route::get('social', 'ConfigController@social')->name('config.social');
        Route::post('social', 'ConfigController@social')->name('config.social.update');
        Route::get('payment', 'ConfigController@payment')->name('config.payment');
        Route::post('payment', 'ConfigController@payment')->name('config.payment.update');
        Route::get('fontawesome', 'ConfigController@fontawesome')->name('config.fontawesome');
    });

    // Mail Controller Groups
    Route::get('mails/{filter?}', 'MailController@all')->name('admin.mail.list');
    Route::prefix('mail')->group(function(){
        Route::get('compose/{mail?}' , 'AdminController@compose')->name('admin.mail.compose');
        Route::post('compose/{mail?}', 'AdminController@sendMail');

        Route::get('{mail}', 'MailController@view')->name('admin.mail.index');
        Route::get('delete/{mail}', 'MailController@delete')->name('admin.mail.delete');
    });
});
