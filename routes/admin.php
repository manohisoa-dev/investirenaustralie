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
// ROUTE SUPER ADMIN
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
    Route::post('AjaxFonDossierEdit', 'ProductController@AjaxFonDossierEdit')->name('AjaxFonDossierEdit'); 
    Route::post('AjaxEoiDossierEdit', 'ProductController@AjaxEoiDossierEdit')->name('AjaxEoiDossierEdit');      
    Route::get('ajaxCheckFirb', 'ProductController@ajaxCheckFirb')->name('ajaxCheckFirb');  
    Route::post('ajaxDropPhotoIcon', 'ProductController@ajaxDropPhotoIcon')->name('ajaxDropPhotoIcon'); 
    Route::post('ajaxDropFondDossier', 'ProductController@ajaxDropFondDossier')->name('ajaxDropFondDossier');  
    Route::post('ajaxDropEoiDossier', 'ProductController@ajaxDropEoiDossier')->name('ajaxDropEoiDossier');  
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
    Route::get('user/relation-apl/{user}', 'UserController@aplRelation')->name('user.relation');
    Route::post('ajaxDropRelation', 'UserController@ajaxDropRelation')->name('ajaxDropRelation');  
    
    Route::get('user/show/seller', 'UserController@showSeller')->name('user.show.seller');
    Route::get('user/show/afa', 'UserController@showAfa')->name('user.show.afa');
    Route::get('user/show/apl', 'UserController@showApl')->name('user.show.apl');
    Route::get('user/show/member', 'UserController@showMember')->name('user.show.member');
    Route::get('user/show/member/type/particulier', 'UserController@showMemberParticulier')->name('user.show.member.particulier');
    Route::get('user/show/member/type/organisation', 'UserController@showMemberOrganisation')->name('user.show.member.organisation');
    Route::get('user/show/collaborator', 'UserController@showCollaborator')->name('user.show.collaborator');
    Route::get('user/create/collaborator', 'UserController@createCollaborator')->name('user.create.collaborator');

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
    Route::resource('mails-template','MailsTemplateController');
    Route::resource('parameters-email','ParametersEmailController');
    Route::resource('temoignage','TemoignageController');
    Route::get('pdfTest', 'TemoignageController@pdfTest')->name('pdfTest');
    Route::post('infoPost', 'TemoignageController@infoPost')->name('infoPost');

    // Route Chat
    Route::get('message/list/contact', 'MessageController@getListContactMessage')->name('ajax.get.list.contact.message');
    Route::get('message/show/{to_id}', 'MessageController@showContactMessage')->name('ajax.show.contact.message');
    Route::post('message', 'MessageController@sendMessage')->name('ajax.send.message');
    Route::get('message/unread', 'MessageController@getUnreadMessage')->name('ajax.get.unread.message');
    
    //Route modèle message
    Route::resource('model-message','ModelMessageController');
    //Route template newsletters
    Route::resource('newsletter-template','NewsletterTemplateController');
    //Route inscris newsletters
    Route::resource('newsletter','NewsletterController');
    Route::post('ajaxSendNewsLetter', 'NewsletterTemplateController@ajaxSendNewsLetter')->name('ajaxSendNewsLetter');
    
});

// ROUTE ADMIN DELEGATE
Route::prefix('collaborators')->namespace('Admin')->as('admin.')->middleware(["auth","role:6"])->group(function(){
    Route::get('/', 'AdminController@dashboard')->name('collaborators.dashboard');

    // Blog Controller
    // Route::resource('blog','BlogController');
    Route::get('/admin/blog', 'BlogController@index')->name('collaborators.admin.blog.index');
    Route::post('/admin/blog', 'BlogController@store')->name('collaborators.admin.blog.store');
    Route::get('/admin/blog/create', 'BlogController@create')->name('collaborators.admin.blog.create');
    Route::get('/admin/blog/{blog}', 'BlogController@show')->name('collaborators.admin.blog.show');
    Route::put('/admin/blog/{blog}', 'BlogController@update')->name('collaborators.admin.blog.update');
    Route::delete('/admin/blog/{blog}', 'BlogController@destroy')->name('collaborators.admin.blog.destroy');
    Route::get('/admin/blog/{blog}/edit', 'BlogController@edit')->name('collaborators.admin.blog.edit');
    Route::get('archive_blog/{blog}', 'BlogController@archive')->name('collaborators.admin.blog.archive');
    Route::get('publish_blog/{blog}', 'BlogController@publish')->name('collaborators.admin.blog.publish');  
    Route::get('trash_blog/{blog}', 'BlogController@trash')->name('collaborators.admin.blog.trash');  
    Route::get('restore_blog/{blog}', 'BlogController@restore')->name('collaborators.admin.blog.restore');
    Route::post('save_blog', 'BlogController@store')->name('collaborators.admin.blog.store');
    Route::get('update_order', 'BlogController@updateBlogOrder')->name('collaborators.admin.blog.update.order');
    
    // Comment Controller
    // Route::resource('comment','CommentController');
    Route::get('/admin/comment', 'CommentController@index')->name('collaborators.admin.comment.index');
    Route::post('/admin/comment', 'CommentController@store')->name('collaborators.admin.comment.store');
    Route::get('/admin/comment/create', 'CommentController@create')->name('collaborators.admin.comment.create');
    Route::get('/admin/comment/{comment}', 'CommentController@show')->name('collaborators.admin.comment.show');
    Route::put('/admin/comment/{comment}', 'CommentController@update')->name('collaborators.admin.comment.update');
    Route::delete('/admin/comment/{comment}', 'CommentController@destroy')->name('collaborators.admin.comment.destroy');
    Route::get('/admin/comment/{comment}/edit', 'CommentController@edit')->name('collaborators.admin.comment.edit');
    
    Route::get('/chart/{type}', 'ChartController@chart')->name('collaborators.admin.chart');
    Route::get('api/chart/categories', 'ChartController@categories')->name('collaborators.admin.chart.categories');
    Route::get('api/chart/locations/{type?}', 'ChartController@locations')->name('collaborators.admin.chart.locations');
    Route::get('api/chart/prices', 'ChartController@prices')->name('collaborators.admin.chart.prices');
    Route::get('api/chart/sellers', 'ChartController@sellers')->name('collaborators.admin.chart.sellers');
    Route::get('api/chart/dates/{role?}', 'ChartController@dates')->name('collaborators.admin.chart.dates');
    
    //profil
    Route::get('profile', 'ProfileController@index')->name('collaborators.admin.profile');
    
    //Route::get('comments/{blog}/{filter?}', 'CommentController@all')->name('comment.list');

    
    Route::post('info', 'ProfileController@editProfile')->name('collaborators.admin.profile.info');
    Route::post('update', 'ProfileController@updateLocation')->name('collaborators.admin.location.edit');
    Route::post('password', 'ProfileController@updatePassword')->name('collaborators.admin.password');
    
    // Route::resource('menu','MenuController');
    Route::get('/admin/menu', 'MenuController@index')->name('collaborators.admin.menu.index');
    Route::post('/admin/menu', 'MenuController@store');
    Route::get('/admin/menu/create', 'MenuController@create');
    Route::get('/admin/menu/{menu}', 'MenuController@show');
    Route::put('/admin/menu/{menu}', 'MenuController@update');
    Route::delete('/admin/menu/{menu}', 'MenuController@destroy');
    Route::get('/admin/menu/{menu}/edit', 'MenuController@edit');

    // Route::resource('country','CountryController');
    Route::get('/admin/country', 'CountryController@index')->name('collaborators.admin.country.index');
    Route::post('/admin/country', 'CountryController@store')->name('collaborators.admin.country.store');
    Route::get('/admin/country/create', 'CountryController@create')->name('collaborators.admin.country.create');
    Route::get('/admin/country/{country}', 'CountryController@show')->name('collaborators.admin.country.show');
    Route::put('/admin/country/{country}', 'CountryController@update')->name('collaborators.admin.country.update');
    Route::delete('/admin/country/{country}', 'CountryController@destroy')->name('collaborators.admin.country.destroy');
    Route::get('/admin/country/{country}/edit', 'CountryController@edit')->name('collaborators.admin.country.edit');

    // Route::resource('state','StateController');
    Route::get('/admin/state', 'StateController@index')->name('collaborators.admin.state.index');
    Route::post('/admin/state', 'StateController@store')->name('collaborators.admin.state.store');
    Route::get('/admin/state/create', 'StateController@create')->name('collaborators.admin.state.create');
    Route::get('/admin/state/{state}', 'StateController@show')->name('collaborators.admin.state.show');
    Route::put('/admin/state/{state}', 'StateController@update')->name('collaborators.admin.state.update');
    Route::delete('/admin/state/{state}', 'StateController@destroy')->name('collaborators.admin.state.destroy');
    Route::get('/admin/state/{state}/edit', 'StateController@edit')->name('collaborators.admin.state.edit');

    // Route::resource('category','CategoryController');
    Route::get('/admin/category', 'CategoryController@index')->name('collaborators.admin.category.index');
    Route::post('/admin/category', 'CategoryController@store')->name('collaborators.admin.category.store');
    Route::get('/admin/category/create', 'CategoryController@create')->name('collaborators.admin.category.create');
    Route::get('/admin/category/{category}', 'CategoryController@show')->name('collaborators.admin.category.show');
    Route::put('/admin/category/{category}', 'CategoryController@update')->name('collaborators.admin.category.update');
    Route::delete('/admin/category/{category}', 'CategoryController@destroy')->name('collaborators.admin.category.destroy');
    Route::get('/admin/category/{category}/edit', 'CategoryController@edit')->name('collaborators.admin.category.edit');

    // Route::resource('pub','PubController');
    Route::get('/admin/pub', 'PubController@index')->name('collaborators.admin.pub.index');
    Route::post('/admin/pub', 'PubController@store')->name('collaborators.admin.pub.store');
    Route::get('/admin/pub/create', 'PubController@create')->name('collaborators.admin.pub.create');
    Route::get('/admin/pub/{pub}', 'PubController@show')->name('collaborators.admin.pub.show');
    Route::put('/admin/pub/{pub}', 'PubController@update')->name('collaborators.admin.pub.update');
    Route::delete('/admin/pub/{pub}', 'PubController@destroy')->name('collaborators.admin.pub.destroy');
    Route::get('/admin/pub/{pub}/edit', 'PubController@edit')->name('collaborators.admin.pub.edit');
    Route::post('ajaxRequest', 'PubController@ajaxRequestPost')->name('ajaxRequest.post');

    // Route::resource('badword','BadwordController');
    Route::get('/admin/badword', 'BadwordController@index')->name('collaborators.admin.badword.index');
    Route::post('/admin/badword', 'BadwordController@store')->name('collaborators.admin.badword.store');
    Route::get('/admin/badword/create', 'BadwordController@create')->name('collaborators.admin.badword.create');
    Route::get('/admin/badword/{badword}', 'BadwordController@show')->name('collaborators.admin.badword.show');
    Route::put('/admin/badword/{badword}', 'BadwordController@update')->name('collaborators.admin.badword.update');
    Route::delete('/admin/badword/{badword}', 'BadwordController@destroy')->name('collaborators.admin.badword.destroy');
    Route::get('/admin/badword/{badword}/edit', 'BadwordController@edit')->name('collaborators.admin.badword.edit');

    // Route::resource('postalcode','PostalcodeController');
    Route::get('/admin/postalcode', 'PostalcodeController@index')->name('collaborators.admin.postalcode.index');
    Route::post('/admin/postalcode', 'PostalcodeController@store')->name('collaborators.admin.postalcode.store');
    Route::get('/admin/postalcode/create', 'PostalcodeController@create')->name('collaborators.admin.postalcode.create');
    Route::get('/admin/postalcode/{postalcode}', 'PostalcodeController@show')->name('collaborators.admin.postalcode.show');
    Route::put('/admin/postalcode/{postalcode}', 'PostalcodeController@update')->name('collaborators.admin.postalcode.update');
    Route::delete('/admin/postalcode/{postalcode}', 'PostalcodeController@destroy')->name('collaborators.admin.postalcode.destroy');
    Route::get('/admin/postalcode/{postalcode}/edit', 'PostalcodeController@edit')->name('collaborators.admin.postalcode.edit');

    // Route::resource('plan','PlanController');
    Route::get('/admin/plan', 'PlanController@index')->name('collaborators.admin.plan.index');
    Route::post('/admin/plan', 'PlanController@store')->name('collaborators.admin.plan.store');
    Route::get('/admin/plan/create', 'PlanController@create')->name('collaborators.admin.plan.create');
    Route::get('/admin/plan/{plan}', 'PlanController@show')->name('collaborators.admin.plan.show');
    Route::put('/admin/plan/{plan}', 'PlanController@update')->name('collaborators.admin.plan.update');
    Route::delete('/admin/plan/{plan}', 'PlanController@destroy')->name('collaborators.admin.plan.destroy');
    Route::get('/admin/plan/{plan}/edit', 'PlanController@edit')->name('collaborators.admin.plan.edit');

    // Route::resource('type','TypeController');
    Route::get('/admin/type', 'TypeController@index')->name('collaborators.admin.type.index');
    Route::post('/admin/type', 'TypeController@store')->name('collaborators.admin.type.store');
    Route::get('/admin/type/create', 'TypeController@create')->name('collaborators.admin.type.create');
    Route::get('/admin/type/{type}', 'TypeController@show')->name('collaborators.admin.type.show');
    Route::put('/admin/type/{type}', 'TypeController@update')->name('collaborators.admin.type.update');
    Route::delete('/admin/type/{type}', 'TypeController@destroy')->name('collaborators.admin.type.destroy');
    Route::get('/admin/type/{type}/edit', 'TypeController@edit')->name('collaborators.admin.type.edit');

    // Route::resource('page','PageController');
    Route::get('/admin/page', 'PageController@index')->name('collaborators.admin.page.index');
    Route::post('/admin/page', 'PageController@store')->name('collaborators.admin.page.store');
    Route::get('/admin/page/create', 'PageController@create')->name('collaborators.admin.page.create');
    Route::get('/admin/page/{page}', 'PageController@show')->name('collaborators.admin.page.show');
    Route::put('/admin/page/{page}', 'PageController@update')->name('collaborators.admin.page.update');
    Route::delete('/admin/page/{page}', 'PageController@destroy')->name('collaborators.admin.page.destroy');
    Route::get('/admin/page/{page}/edit', 'PageController@edit')->name('collaborators.admin.page.edit');

    // Route::resource('mail','MailController');
    Route::get('/admin/mail', 'MailController@index')->name('collaborators.admin.mail.index');
    Route::post('/admin/mail', 'MailController@store')->name('collaborators.admin.mail.store');
    Route::get('/admin/mail/create', 'MailController@create')->name('collaborators.admin.mail.create');
    Route::get('/admin/mail/{mail}', 'MailController@show')->name('collaborators.admin.mail.show');
    Route::put('/admin/mail/{mail}', 'MailController@update')->name('collaborators.admin.mail.update');
    Route::delete('/admin/mail/{mail}', 'MailController@destroy')->name('collaborators.admin.mail.destroy');
    Route::get('/admin/mail/{mail}/edit', 'MailController@edit')->name('collaborators.admin.mail.edit');
    Route::get('mailtype/{filter}', 'MailController@all')->name('collaborators.admin.mail.list');
    Route::get('compose/{mail?}' , 'AdminController@compose')->name('collaborators.admin.mail.compose');
    Route::post('compose/{mail?}', 'AdminController@sendMail')->name('collaborators.admin.mail.sendmail');
    
    // Route::resource('product','ProductController');
    Route::get('/admin/product', 'ProductController@index')->name('collaborators.admin.product.index');
    Route::post('/admin/product', 'ProductController@store')->name('collaborators.admin.product.store');
    Route::get('/admin/product/create', 'ProductController@create')->name('collaborators.admin.product.create');
    Route::get('/admin/product/{product}', 'ProductController@show')->name('collaborators.admin.product.show');
    Route::put('/admin/product/{product}', 'ProductController@update')->name('collaborators.admin.product.update');
    Route::delete('/admin/product/{product}', 'ProductController@destroy')->name('collaborators.admin.product.destroy');
    Route::get('/admin/product/{product}/edit', 'ProductController@edit')->name('collaborators.admin.product.edit');
    Route::post('/admin/ajaxRequestProduct', 'ProductController@ajaxRequestPost')->name('collaborators.admin.ajaxRequestProduct.post');  
    Route::post('/admin/ajaxRequestProgramme', 'ProductController@ajaxRequestProgramme')->name('collaborators.admin.ajaxRequestProgramme.post'); 
    Route::post('/admin/ajaxGetTypeProduitCategorie', 'ProductController@ajaxGetTypeProduitCategorie')->name('collaborators.admin.ajaxGetTypeProduitCategorie'); 
    Route::post('/admin/ajaxDropZone', 'ProductController@ajaxDropZone')->name('collaborators.admin.ajaxDropZone');
    Route::post('/admin/ajaxDropZoneEdit', 'ProductController@ajaxDropZoneEdit')->name('collaborators.admin.ajaxDropZoneEdit');    
    Route::get('/admin/ajaxCheckFirb', 'ProductController@ajaxCheckFirb')->name('collaborators.admin.ajaxCheckFirb');  
    Route::post('/admin/ajaxDropPhotoIcon', 'ProductController@ajaxDropPhotoIcon')->name('collaborators.admin.ajaxDropPhotoIcon');  
    Route::post('/admin/ajaxDropFondDossier', 'ProductController@ajaxDropFondDossier')->name('collaborators.admin.ajaxDropFondDossier');
    Route::post('/admin/ajaxDropEoiDossier', 'ProductController@ajaxDropEoiDossier')->name('collaborators.admin.ajaxDropEoiDossier');      
    Route::post('/admin/ajaxDropProduit', 'ProductController@ajaxDropProduit')->name('collaborators.admin.ajaxDropProduit');  
    Route::post('/admin/ajaxChangeIconPhotoActive', 'ProductController@ajaxChangeIconPhotoActive')->name('collaborators.admin.ajaxChangeIconPhotoActive');
    Route::post('/admin/ajaxSaveProduct', 'ProductController@ajaxSaveProduct')->name('collaborators.admin.ajaxSaveProduct');
    Route::post('/admin/ajaxModifProduct', 'ProductController@ajaxModifProduct')->name('collaborators.admin.ajaxModifProduct');
    Route::post('/admin/ajaxGetProductById', 'ProductController@ajaxGetProductById')->name('collaborators.admin.ajaxGetProductById');    
    Route::get('/admin/ajaxCheckTitreProgramme', 'ProductController@ajaxCheckTitreProgramme')->name('collaborators.admin.ajaxCheckTitreProgramme');      
    Route::get('archive/{product}', 'ProductController@archive')->name('collaborators.admin.product.archive');
    Route::get('trash/{product}', 'ProductController@trash')->name('collaborators.admin.product.trash');
    Route::get('restore/{product}', 'ProductController@restore')->name('collaborators.admin.product.restore');
    Route::get('publish/{product}', 'ProductController@publish')->name('collaborators.admin.product.publish');
    Route::get('programme', 'ProductController@programme')->name('collaborators.admin.product.programme');

    // Route::resource('user','UserController');
    Route::get('/admin/user', 'UserController@index')->name('collaborators.admin.user.index');
    Route::post('/admin/user', 'UserController@store')->name('collaborators.admin.user.store');
    Route::get('/admin/user/create', 'UserController@create')->name('collaborators.admin.user.create');
    Route::get('/admin/user/{user}', 'UserController@show')->name('collaborators.admin.user.show');
    Route::put('/admin/user/{user}', 'UserController@update')->name('collaborators.admin.user.update');
    Route::delete('/admin/user/{user}', 'UserController@destroy')->name('collaborators.admin.user.destroy');
    Route::get('/admin/user/{user}/edit', 'UserController@edit')->name('collaborators.admin.user.edit');
    Route::get('desactiver/{user}', 'UserController@desactiver')->name('collaborators.admin.user.desactiver');
    Route::get('active/{user}', 'UserController@active')->name('collaborators.admin.user.active');
    Route::get('contact/{user}' , 'UserController@contact')->name('collaborators.admin.user.contact');
    Route::get('show/{user}', 'UserController@show')->name('collaborators.admin.user.show');
    Route::get('user/show/{role}/{user}', 'UserController@showPart')->name('collaborators.admin.user.part.show');
    Route::get('user/show/seller', 'UserController@showSeller')->name('collaborators.admin.user.show.seller');
    Route::get('user/show/afa', 'UserController@showAfa')->name('collaborators.admin.user.show.afa');
    Route::get('user/show/apl', 'UserController@showApl')->name('collaborators.admin.user.show.apl');
    Route::get('user/show/member', 'UserController@showMember')->name('collaborators.admin.user.show.member');
    Route::get('user/show/member/type/particulier', 'UserController@showMemberParticulier')->name('collaborators.admin.user.show.member.particulier');
    Route::get('user/show/member/type/organisation', 'UserController@showMemberOrganisation')->name('collaborators.admin.user.show.member.organisation');
    Route::get('user/show/collaborator', 'UserController@showCollaborator')->name('collaborators.admin.user.show.collaborator');
    Route::get('user/create/collaborator', 'UserController@createCollaborator')->name('collaborators.admin.user.create.collaborator');

    // Route::resource('sale','SaleController');
    Route::get('/admin/sale', 'SaleController@index')->name('collaborators.admin.sale.index');
    Route::post('/admin/sale', 'SaleController@store')->name('collaborators.admin.sale.store');
    Route::get('/admin/sale/create', 'SaleController@create')->name('collaborators.admin.sale.create');
    Route::get('/admin/sale/{sale}', 'SaleController@show')->name('collaborators.admin.sale.show');
    Route::put('/admin/sale/{sale}', 'SaleController@update')->name('collaborators.admin.sale.update');
    Route::delete('/admin/sale/{sale}', 'SaleController@destroy')->name('collaborators.admin.sale.destroy');
    Route::get('/admin/sale/{sale}/edit', 'SaleController@edit')->name('collaborators.admin.sale.edit');
    Route::get('pay/{sale}/{role}', 'SaleController@pay')->name('collaborators.admin.sale.pay');

    // Route::resource('role','RoleController');
    Route::get('/admin/role', 'RoleController@index')->name('collaborators.admin.role.index');
    Route::post('/admin/role', 'RoleController@store')->name('collaborators.admin.role.store');
    Route::get('/admin/role/create', 'RoleController@create')->name('collaborators.admin.role.create');
    Route::get('/admin/role/{role}', 'RoleController@show')->name('collaborators.admin.role.show');
    Route::put('/admin/role/{role}', 'RoleController@update')->name('collaborators.admin.role.update');
    Route::delete('/admin/role/{role}', 'RoleController@destroy')->name('collaborators.admin.role.destroy');
    Route::get('/admin/role/{role}/edit', 'RoleController@edit')->name('collaborators.admin.role.edit');

    // Route::resource('type-user','TypeUserController');
    Route::get('/admin/type-user', 'TypeUserController@index')->name('collaborators.admin.type-user.index');
    Route::post('/admin/type-user', 'TypeUserController@store')->name('collaborators.admin.type-user.store');
    Route::get('/admin/type-user/create', 'TypeUserController@create')->name('collaborators.admin.type-user.create');
    Route::get('/admin/type-user/{type_user}', 'TypeUserController@show')->name('collaborators.admin.type-user.show');
    Route::put('/admin/type-user/{type_user}', 'TypeUserController@update')->name('collaborators.admin.type-user.update');
    Route::delete('/admin/type-user/{type_user}', 'TypeUserController@destroy')->name('collaborators.admin.type-user.destroy');
    Route::get('/admin/type-user/{type_user}/edit', 'TypeUserController@edit')->name('collaborators.admin.type-user.edit');
    
    // Route::resource('slider','SliderController');
    Route::get('/admin/slider', 'SliderController@index')->name('collaborators.admin.slider.index');
    Route::post('/admin/slider', 'SliderController@store')->name('collaborators.admin.slider.store');
    Route::get('/admin/slider/create', 'SliderController@create')->name('collaborators.admin.slider.create');
    Route::get('/admin/slider/{slider}', 'SliderController@show')->name('collaborators.admin.slider.show');
    Route::put('/admin/slider/{slider}', 'SliderController@update')->name('collaborators.admin.slider.update');
    Route::delete('/admin/slider/{slider}', 'SliderController@destroy')->name('collaborators.admin.slider.destroy');
    Route::get('/admin/slider/{slider}/edit', 'SliderController@edit')->name('collaborators.admin.slider.edit');
    Route::get('slider/desactiver/{slider}', 'SliderController@desactiver')->name('collaborators.admin.slider.desactiver');
    Route::get('slider/activer/{slider}', 'SliderController@activer')->name('collaborators.admin.slider.activer');

    // Config Controller
    Route::prefix('config')->as('collaborators.config.')->group(function () {
        Route::get('/admin/site', 'ConfigController@site')->name('site');
        Route::post('/admin/site', 'ConfigController@site')->name('site.update');
        Route::get('/admin/login', 'ConfigController@login')->name('login');
        Route::post('/admin/login', 'ConfigController@login')->name('login.update');
        Route::get('/admin/social', 'ConfigController@social')->name('social');
        Route::post('/admin/social', 'ConfigController@social')->name('social.update');
        Route::get('/admin/payment', 'ConfigController@payment')->name('payment');
        Route::post('/admin/payment', 'ConfigController@payment')->name('payment.update');
        Route::get('/admin/fontawesome', 'ConfigController@fontawesome')->name('fontawesome');
        Route::get('/admin/translation', 'TranslationController@translation')->name('translation');
        Route::post('/admin/translation', 'TranslationController@saveTranslation')->name('save.translation');
        Route::get('/admin/get/translation', 'TranslationController@getTranslation')->name('get.translation');
        Route::get('/admin/parameter', 'ParameterController@show')->name('parameter');
        Route::post('/admin/parameter', 'ParameterController@update')->name('update.parameter');
    });

    // Route::resource('firb','FirbController');
    Route::get('/admin/firb', 'FirbController@index')->name('collaborators.admin.firb.index');
    Route::post('/admin/firb', 'FirbController@store')->name('collaborators.admin.firb.store');
    Route::get('/admin/firb/create', 'FirbController@create')->name('collaborators.admin.firb.create');
    Route::get('/admin/firb/{firb}', 'FirbController@show')->name('collaborators.admin.firb.show');
    Route::put('/admin/firb/{firb}', 'FirbController@update')->name('collaborators.admin.firb.update');
    Route::delete('/admin/firb/{firb}', 'FirbController@destroy')->name('collaborators.admin.firb.destroy');
    Route::get('/admin/firb/{firb}/edit', 'FirbController@edit')->name('collaborators.admin.firb.edit');
    Route::get('/admin/media', 'MediaController@show')->name('collaborators.admin.media');
    Route::get('/admin/get/{limit?}', 'MediaController@index')->name('collaborators.admin.midia.get');
    Route::post('ajaxFile', 'MediaController@ajaxFile')->name('collaborators.admin.ajaxFile');
    Route::post('ajaxDeleteFile', 'MediaController@ajaxDeleteFile')->name('collaborators.admin.ajaxDeleteFile');
    Route::post('ajaxGetFile', 'MediaController@ajaxGetFile')->name('collaborators.admin.ajaxGetFile');
    Route::post('ajaxSaveFileEdit', 'MediaController@ajaxSaveFileEdit')->name('collaborators.admin.ajaxSaveFileEdit');
    Route::get('ajaxReadFile/{limit?}', 'MediaController@ajaxReadFile')->name('collaborators.admin.ajaxReadFile');
    
    //Route::resource('model-message','admin\ModelMessageController');
    Route::get('/admin/model-message', 'ModelMessageController@index')->name('collaborators.admin.model-message.index');
    Route::get('/admin/model-message/create', 'ModelMessageController@create')->name('collaborators.admin.model-message.create');
    Route::post('/admin/model-message', 'ModelMessageController@store')->name('collaborators.admin.model-message.store');
    Route::get('/admin/model-message/{firb}', 'ModelMessageController@show')->name('collaborators.admin.model-message.show');
    Route::put('/admin/model-message/{firb}', 'ModelMessageController@update')->name('collaborators.admin.model-message.update');
    Route::delete('/admin/model-message/{firb}', 'ModelMessageController@destroy')->name('collaborators.admin.model-message.destroy');
    Route::get('/admin/model-message/{firb}/edit', 'ModelMessageController@edit')->name('collaborators.admin.model-message.edit');
    
    //Route::resource('newsletter-template','NewsletterTemplateController');
    Route::get('/admin/newsletter-template', 'NewsletterTemplateController@index')->name('collaborators.admin.newsletter-template.index');
    Route::get('/admin/newsletter-template/create', 'NewsletterTemplateController@create')->name('collaborators.admin.newsletter-template.create');
    Route::post('/admin/newsletter-template', 'NewsletterTemplateController@store')->name('collaborators.admin.newsletter-template.store');
    Route::get('/admin/newsletter-template/{firb}', 'NewsletterTemplateController@show')->name('collaborators.admin.newsletter-template.show');
    Route::put('/admin/newsletter-template/{firb}', 'NewsletterTemplateController@update')->name('collaborators.admin.newsletter-template.update');
    Route::delete('/admin/newsletter-template/{firb}', 'NewsletterTemplateController@destroy')->name('collaborators.admin.newsletter-template.destroy');
    Route::get('/admin/newsletter-template/{firb}/edit', 'NewsletterTemplateController@edit')->name('collaborators.admin.newsletter-template.edit');
    Route::post('ajaxSendNewsLetter', 'NewsletterTemplateController@ajaxSendNewsLetter')->name('collaborators.admin.ajaxSendNewsLetter');
    
    // Route::resource('mails-template','MailsTemplateController');
    Route::get('/admin/mails-template', 'MailsTemplateController@index')->name('collaborators.admin.mails-template.index');
    Route::post('/admin/mails-template', 'MailsTemplateController@store')->name('collaborators.admin.mails-template.store');
    Route::get('/admin/mails-template/create', 'MailsTemplateController@create')->name('collaborators.admin.mails-template.create');
    Route::get('/admin/mails-template/{mails_template}', 'MailsTemplateController@show')->name('collaborators.admin.mails-template.show');
    Route::put('/admin/mails-template/{mails_template}', 'MailsTemplateController@update')->name('collaborators.admin.mails-template.update');
    Route::delete('/admin/mails-template/{mails_template}', 'MailsTemplateController@destroy')->name('collaborators.admin.mails-template.destroy');
    Route::get('/admin/mails-template/{mails_template}/edit', 'MailsTemplateController@edit')->name('collaborators.admin.mails-template.edit');
    
    //Route::resource('newsletter','NewsletterController');
    Route::get('/admin/newsletter', 'NewsletterController@index')->name('collaborators.admin.newsletter.index');
    Route::delete('/admin/newsletter/{newsletter}', 'NewsletterController@destroy')->name('collaborators.admin.newsletter.destroy');
    
    
    // Route::resource('parameters-email','ParametersEmailController');
    Route::get('/admin/parameters-email', 'ParametersEmailController@index')->name('collaborators.admin.parameters-email.index');
    Route::post('/admin/parameters-email', 'ParametersEmailController@store')->name('collaborators.admin.parameters-email.store');
    Route::get('/admin/parameters-email/create', 'ParametersEmailController@create')->name('collaborators.admin.parameters-email.create');
    Route::get('/admin/parameters-email/{parameters_email}', 'ParametersEmailController@show')->name('collaborators.admin.parameters-email.show');
    Route::put('/admin/parameters-email/{parameters_email}', 'ParametersEmailController@update')->name('collaborators.admin.parameters-email.update');
    Route::delete('/admin/parameters-email/{parameters_email}', 'ParametersEmailController@destroy')->name('collaborators.admin.parameters-email.destroy');
    Route::get('/admin/parameters-email/{parameters_email}/edit', 'ParametersEmailController@edit')->name('collaborators.admin.parameters-email.edit');

    // Route::resource('temoignage','TemoignageController');
    Route::get('/admin/temoignage', 'TemoignageController@index')->name('collaborators.admin.temoignage.index');
    Route::post('/admin/temoignage', 'TemoignageController@store')->name('collaborators.admin.temoignage.store');
    Route::get('/admin/temoignage/create', 'TemoignageController@create')->name('collaborators.admin.temoignage.create');
    Route::get('/admin/temoignage/{temoignage}', 'TemoignageController@show')->name('collaborators.admin.temoignage.show');
    Route::put('/admin/temoignage/{temoignage}', 'TemoignageController@update')->name('collaborators.admin.temoignage.update');
    Route::delete('/admin/temoignage/{temoignage}', 'TemoignageController@destroy')->name('collaborators.admin.temoignage.destroy');
    Route::get('/admin/temoignage/{temoignage}/edit', 'TemoignageController@edit')->name('collaborators.admin.temoignage.edit');
    Route::get('pdfTest', 'TemoignageController@pdfTest')->name('pdfTest');
    Route::get('/admin/pdfTest/{id}', 'TemoignageController@pdfTest')->name('collaborators.admin.pdfTest');

    // Route Chat
    Route::get('/admin/message/list/contact', 'MessageController@getListContactMessage')->name('collaborators.admin.ajax.get.list.contact.message');
    Route::get('/admin/message/show/{to_id}', 'MessageController@showContactMessage')->name('collaborators.admin.ajax.show.contact.message');
    Route::post('/admin/message', 'MessageController@sendMessage')->name('collaborators.admin.ajax.send.message');
    Route::get('/admin/message/unread', 'MessageController@getUnreadMessage')->name('collaborators.admin.ajax.get.unread.message');
});


// ROUTE ADMIN BLOG
Route::prefix('collaborator')->namespace('Admin')->as('admin.')->middleware(["auth","role:6"])->group(function(){
    Route::get('/', 'AdminController@dashboard')->name('collaborator.dashboard');
    Route::get('/admin/blog/create', 'BlogController@create')->name('collaborator.admin.blog.create');
    Route::post('/admin/blog/store', 'BlogController@store')->name('collaborator.admin.blog.store');
    Route::get('/admin/blog', 'BlogController@index')->name('collaborator.admin.blog.index');

    // Blog Controller
    // Route::resource('blog','BlogController');
    Route::get('/admin/blog/{blog}/edit', 'BlogController@edit');
    Route::put('/admin/blog/{blog}', 'BlogController@update');
    Route::delete('/admin/blog/{blog}', 'BlogController@destroy');
    Route::get('archive_blog/{blog}', 'BlogController@archive')->name('collaborator.admin.blog.archive');
    Route::get('publish_blog/{blog}', 'BlogController@publish')->name('collaborator.admin.blog.publish');  
    Route::get('trash_blog/{blog}', 'BlogController@trash')->name('collaborator.admin.blog.trash');  
    Route::get('restore_blog/{blog}', 'BlogController@restore')->name('collaborator.admin.blog.restore');
    Route::post('save_blog', 'BlogController@store')->name('collaborator.admin.blog.store');
    Route::get('update_order', 'BlogController@updateBlogOrder')->name('collaborator.admin.blog.update.order');
    
    // Comment Controller
    // Route::resource('comment','CommentController');
    Route::get('/admin/comment', 'CommentController@index')->name('collaborator.admin.comment.index');
    Route::get('/admin/comment/{comment}', 'CommentController@show');
    Route::get('/admin/comment/{comment}/edit', 'CommentController@edit');
    Route::put('/admin/comment/{comment}', 'CommentController@update');
    Route::delete('/admin/comment/{comment}', 'CommentController@destroy');
    
    // Route::get('/chart/{type}', 'ChartController@chart')->name('chart');
    // Route::get('api/chart/categories', 'ChartController@categories')->name('chart.categories');
    // Route::get('api/chart/locations/{type?}', 'ChartController@locations')->name('chart.locations');
    // Route::get('api/chart/prices', 'ChartController@prices')->name('chart.prices');
    // Route::get('api/chart/sellers', 'ChartController@sellers')->name('chart.sellers');
    // Route::get('api/chart/dates/{role?}', 'ChartController@dates')->name('chart.dates');
    
    //profil
    Route::get('profile', 'ProfileController@index')->name('collaborator.admin.profile');
    
    //Route::get('comments/{blog}/{filter?}', 'CommentController@all')->name('comment.list');

    
    Route::post('info', 'ProfileController@editProfile')->name('profile.info');
    Route::post('update', 'ProfileController@updateLocation')->name('location.edit');
    Route::post('password', 'ProfileController@updatePassword')->name('password');
    
    Route::resource('menu','MenuController');

    Route::resource('country','CountryController');
    Route::resource('state','StateController');

    // Route::resource('category','CategoryController');
    // Route::get('category/{category}/edit', 'CategoryController@edit')->name('category.edit');
    // Route::put('category/{category}', 'CategoryController@update')->name('category.update');
    // Route::delete('category/{category}', 'CategoryController@destroy')->name('category.destroy');

    // Route::resource('pub','PubController');
    // Route::post('ajaxRequest', 'PubController@ajaxRequestPost')->name('ajaxRequest.post');
    // Route::resource('badword','BadwordController');
    // Route::resource('postalcode','PostalcodeController');
    // Route::resource('plan','PlanController');
    // Route::resource('type','TypeController');
    // Route::resource('page','PageController');
    // Route::resource('mail','MailController');
    // Route::get('mailtype/{filter}', 'MailController@all')->name('mail.list');
    // Route::get('compose/{mail?}' , 'AdminController@compose')->name('mail.compose');
    // Route::post('compose/{mail?}', 'AdminController@sendMail');
    
    // Route::resource('product','ProductController');
    // Route::post('ajaxRequestProduct', 'ProductController@ajaxRequestPost')->name('ajaxRequestProduct.post');  
    // Route::post('ajaxRequestProgramme', 'ProductController@ajaxRequestProgramme')->name('ajaxRequestProgramme.post'); 
    // Route::post('ajaxGetTypeProduitCategorie', 'ProductController@ajaxGetTypeProduitCategorie')->name('ajaxGetTypeProduitCategorie'); 
    // Route::post('ajaxDropZone', 'ProductController@ajaxDropZone')->name('ajaxDropZone');
    // Route::post('ajaxDropZoneEdit', 'ProductController@ajaxDropZoneEdit')->name('ajaxDropZoneEdit');    
    // Route::get('ajaxCheckFirb', 'ProductController@ajaxCheckFirb')->name('ajaxCheckFirb');  
    // Route::post('ajaxDropPhotoIcon', 'ProductController@ajaxDropPhotoIcon')->name('ajaxDropPhotoIcon');  
    // Route::post('ajaxDropProduit', 'ProductController@ajaxDropProduit')->name('ajaxDropProduit');  
    // Route::post('ajaxChangeIconPhotoActive', 'ProductController@ajaxChangeIconPhotoActive')->name('ajaxChangeIconPhotoActive');
    // Route::post('ajaxSaveProduct', 'ProductController@ajaxSaveProduct')->name('ajaxSaveProduct');
    // Route::post('ajaxModifProduct', 'ProductController@ajaxModifProduct')->name('ajaxModifProduct');
    // Route::post('ajaxGetProductById', 'ProductController@ajaxGetProductById')->name('ajaxGetProductById');    
    // Route::get('ajaxCheckTitreProgramme', 'ProductController@ajaxCheckTitreProgramme')->name('ajaxCheckTitreProgramme');      
    // Route::get('archive/{product}', 'ProductController@archive')->name('product.archive');
    // Route::get('trash/{product}', 'ProductController@trash')->name('product.trash');
    // Route::get('restore/{product}', 'ProductController@restore')->name('product.restore');
    // Route::get('publish/{product}', 'ProductController@publish')->name('product.publish');
    // Route::get('programme', 'ProductController@programme')->name('product.programme');

    // Route::resource('user','UserController');
    // Route::get('desactiver/{user}', 'UserController@desactiver')->name('user.desactiver');
    // Route::get('active/{user}', 'UserController@active')->name('user.active');
    // Route::get('contact/{user}' , 'UserController@contact')->name('user.contact');
    // Route::get('show/{user}', 'UserController@show')->name('user.show');
    // Route::get('user/show/{role}/{user}', 'UserController@showPart')->name('user.part.show');
    // Route::get('user/show/seller', 'UserController@showSeller')->name('user.show.seller');
    // Route::get('user/show/afa', 'UserController@showAfa')->name('user.show.afa');
    // Route::get('user/show/apl', 'UserController@showApl')->name('user.show.apl');
    // Route::get('user/show/member', 'UserController@showMember')->name('user.show.member');
    // Route::get('user/show/member/type/particulier', 'UserController@showMemberParticulier')->name('user.show.member.particulier');
    // Route::get('user/show/member/type/organisation', 'UserController@showMemberOrganisation')->name('user.show.member.organisation');
    // Route::get('user/show/collaborator', 'UserController@showCollaborator')->name('user.show.collaborator');
    // Route::get('user/create/collaborator', 'UserController@createCollaborator')->name('user.create.collaborator');

    // Route::resource('sale','SaleController');
    // Route::get('pay/{sale}/{role}', 'SaleController@pay')->name('sale.pay');
    // Route::resource('role','RoleController');
    // Route::resource('type-user','TypeUserController');
    
    // Route::resource('slider','SliderController');
    // Route::get('slider/desactiver/{slider}', 'SliderController@desactiver')->name('slider.desactiver');
    // Route::get('slider/activer/{slider}', 'SliderController@activer')->name('slider.activer');

    // Config Controller
    // Route::prefix('config')->as('config.')->group(function () {
    //     Route::get('site', 'ConfigController@site')->name('site');
    //     Route::post('site', 'ConfigController@site')->name('site.update');
    //     Route::get('login', 'ConfigController@login')->name('login');
    //     Route::post('login', 'ConfigController@login')->name('login.update');
    //     Route::get('social', 'ConfigController@social')->name('social');
    //     Route::post('social', 'ConfigController@social')->name('social.update');
    //     Route::get('payment', 'ConfigController@payment')->name('payment');
    //     Route::post('payment', 'ConfigController@payment')->name('payment.update');
    //     Route::get('fontawesome', 'ConfigController@fontawesome')->name('fontawesome');
    //     Route::get('translation', 'TranslationController@translation')->name('translation');
    //     Route::post('translation', 'TranslationController@saveTranslation')->name('save.translation');
    //     Route::get('get/translation', 'TranslationController@getTranslation')->name('get.translation');
    //     Route::get('parameter', 'ParameterController@show')->name('parameter');
    //     Route::post('parameter', 'ParameterController@update')->name('update.parameter');
    // });

    // Route::get('media', 'MediaController@show')->name('media');
    // Route::get('get/{limit?}', 'MediaController@index')->name('midia.get');
    // Route::post('ajaxFile', 'MediaController@ajaxFile')->name('ajaxFile');
    // Route::post('ajaxDeleteFile', 'MediaController@ajaxDeleteFile')->name('ajaxDeleteFile');
    // Route::post('ajaxGetFile', 'MediaController@ajaxGetFile')->name('ajaxGetFile');
    // Route::post('ajaxSaveFileEdit', 'MediaController@ajaxSaveFileEdit')->name('ajaxSaveFileEdit');
    // Route::get('ajaxReadFile/{limit?}', 'MediaController@ajaxReadFile')->name('ajaxReadFile');
});
