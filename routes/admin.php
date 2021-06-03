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
    Route::get('/chart/{type}', 'ChartController@chart')->name('chart');
    Route::get('api/chart/categories', 'ChartController@categories')->name('chart.categories');
    Route::get('api/chart/locations/{type?}', 'ChartController@locations')->name('chart.locations');
    Route::get('api/chart/prices', 'ChartController@prices')->name('chart.prices');
    Route::get('api/chart/sellers', 'ChartController@sellers')->name('chart.sellers');
    Route::get('api/chart/dates/{role?}', 'ChartController@dates')->name('chart.dates');
    //profil

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::post('info', 'ProfileController@editProfile')->name('profile.info');
    Route::post('update', 'ProfileController@updateLocation')->name('location.edit');
    Route::post('password', 'ProfileController@updatePassword')->name('password');
    
    Route::resource('menu','MenuController');

    Route::resource('country','CountryController');
    Route::resource('state','StateController');

    Route::resource('category','CategoryController');
    Route::get('category/{category}/edit', 'CategoryController@edit')->name('category.edit');
    Route::put('category/{category}', 'CategoryController@update')->name('category.update');
    Route::delete('category/{category}', 'CategoryController@destroy')->name('category.destroy');

    Route::resource('pub','PubController');
    Route::post('ajaxRequest', 'PubController@ajaxRequestPost')->name('ajaxRequest.post');
    Route::resource('badword','BadwordController');
    Route::resource('postalcode','PostalcodeController');
    Route::resource('plan','PlanController');
    Route::resource('type','TypeController');
    Route::resource('page','PageController');
    Route::resource('mail','MailController');
    Route::get('mailtype/{filter}', 'MailController@all')->name('mail.list');
    Route::get('compose/{mail?}' , 'AdminController@compose')->name('mail.compose');
    Route::post('compose/{mail?}', 'AdminController@sendMail');
    
    Route::resource('product','ProductController');
    Route::post('ajaxRequestProduct', 'ProductController@ajaxRequestPost')->name('ajaxRequestProduct.post');  
    Route::post('ajaxRequestProgramme', 'ProductController@ajaxRequestProgramme')->name('ajaxRequestProgramme.post'); 
    Route::post('ajaxGetTypeProduitCategorie', 'ProductController@ajaxGetTypeProduitCategorie')->name('ajaxGetTypeProduitCategorie'); 
    Route::post('ajaxDropZone', 'ProductController@ajaxDropZone')->name('ajaxDropZone');  
    Route::post('ajaxDropZoneEdit', 'ProductController@ajaxDropZoneEdit')->name('ajaxDropZoneEdit');    
    Route::get('ajaxCheckFirb', 'ProductController@ajaxCheckFirb')->name('ajaxCheckFirb');  
    Route::post('ajaxDropPhotoIcon', 'ProductController@ajaxDropPhotoIcon')->name('ajaxDropPhotoIcon');  
    Route::post('ajaxDropProduit', 'ProductController@ajaxDropProduit')->name('ajaxDropProduit');  
    Route::post('ajaxChangeIconPhotoActive', 'ProductController@ajaxChangeIconPhotoActive')->name('ajaxChangeIconPhotoActive');
    Route::post('ajaxSaveProduct', 'ProductController@ajaxSaveProduct')->name('ajaxSaveProduct');
    Route::post('ajaxModifProduct', 'ProductController@ajaxModifProduct')->name('ajaxModifProduct');
    Route::post('ajaxGetProductById', 'ProductController@ajaxGetProductById')->name('ajaxGetProductById');    
    Route::get('ajaxCheckTitreProgramme', 'ProductController@ajaxCheckTitreProgramme')->name('ajaxCheckTitreProgramme');      
    Route::get('archive/{product}', 'ProductController@archive')->name('product.archive');
    Route::get('trash/{product}', 'ProductController@trash')->name('product.trash');
    Route::get('restore/{product}', 'ProductController@restore')->name('product.restore');
    Route::get('publish/{product}', 'ProductController@publish')->name('product.publish');
    Route::get('programme', 'ProductController@programme')->name('product.programme');

    Route::resource('blog','BlogController');
    Route::get('archive_blog/{blog}', 'BlogController@archive')->name('blog.archive');
    Route::get('publish_blog/{blog}', 'BlogController@publish')->name('blog.publish');  
    Route::get('trash_blog/{blog}', 'BlogController@trash')->name('blog.trash');  
    Route::get('restore_blog/{blog}', 'BlogController@restore')->name('blog.restore');
    Route::post('save_blog', 'BlogController@store')->name('blog.store');
    Route::get('update_order', 'BlogController@updateBlogOrder')->name('blog.update.order');
    
    Route::resource('comment','CommentController');
    //Route::get('comments/{blog}/{filter?}', 'CommentController@all')->name('comment.list');

    Route::resource('user','UserController');
    Route::get('desactiver/{user}', 'UserController@desactiver')->name('user.desactiver');
    Route::get('active/{user}', 'UserController@active')->name('user.active');
    Route::get('contact/{user}' , 'UserController@contact')->name('user.contact');
    Route::get('show/{user}', 'UserController@show')->name('user.show');
    Route::get('user/show/{role}/{user}', 'UserController@showPart')->name('user.part.show');
    Route::get('user/show/seller', 'UserController@showSeller')->name('user.show.seller');
    Route::get('user/show/afa', 'UserController@showAfa')->name('user.show.afa');
    Route::get('user/show/apl', 'UserController@showApl')->name('user.show.apl');
    Route::get('user/show/member', 'UserController@showMember')->name('user.show.member');
    Route::get('user/show/member/type/particulier', 'UserController@showMemberParticulier')->name('user.show.member.particulier');
    Route::get('user/show/member/type/organisation', 'UserController@showMemberOrganisation')->name('user.show.member.organisation');
    Route::get('user/show/collaborator', 'UserController@showCollaborator')->name('user.show.collaborator');

    Route::resource('sale','SaleController');
    Route::get('pay/{sale}/{role}', 'SaleController@pay')->name('sale.pay');
    Route::resource('role','RoleController');
    Route::resource('type-user','TypeUserController');
    
    Route::resource('slider','SliderController');
    Route::get('slider/desactiver/{slider}', 'SliderController@desactiver')->name('slider.desactiver');
    Route::get('slider/activer/{slider}', 'SliderController@activer')->name('slider.activer');

    // Config Controller
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
        Route::get('translation', 'TranslationController@translation')->name('translation');
        Route::post('translation', 'TranslationController@saveTranslation')->name('save.translation');
        Route::get('get/translation', 'TranslationController@getTranslation')->name('get.translation');
        Route::get('parameter', 'ParameterController@show')->name('parameter');
        Route::post('parameter', 'ParameterController@update')->name('update.parameter');
    });

    Route::resource('firb','FirbController');
    Route::get('media', 'MediaController@show')->name('media');
    Route::get('get/{limit?}', 'MediaController@index')->name('midia.get');
    Route::post('ajaxFile', 'MediaController@ajaxFile')->name('ajaxFile');
    Route::post('ajaxDeleteFile', 'MediaController@ajaxDeleteFile')->name('ajaxDeleteFile');
    Route::post('ajaxGetFile', 'MediaController@ajaxGetFile')->name('ajaxGetFile');
    Route::post('ajaxSaveFileEdit', 'MediaController@ajaxSaveFileEdit')->name('ajaxSaveFileEdit');
    Route::get('ajaxReadFile/{limit?}', 'MediaController@ajaxReadFile')->name('ajaxReadFile');
});
