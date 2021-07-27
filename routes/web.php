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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Localisation
Route::get('localization/{locale}', 'LocalizationController@index')->name('localization');

// Static pages
Route::get('/', 'IndexController@index')->name('home');
Route::get('services', 'IndexController@services')->name('services');
Route::get('about', 'IndexController@about')->name('about');
Route::get('terms', 'IndexController@terms')->name('terms');
Route::get('help', 'IndexController@help')->name('help');
Route::get('publicities', 'IndexController@publicities')->name('publicities');
Route::get('confidentialities', 'IndexController@confidentialities')->name('confidentialities');
Route::get('apls', 'IndexController@apl')->name('apls');
// Shop each apl
Route::get('get/show/apl/{id}', 'IndexController@getShowApl')->name('get.show.apl');
Route::get('show/apl/{id}', 'IndexController@showApl')->name('show.apl');
// Get APL footer
Route::get('getApl/{country}/{locality}', 'IndexController@getApl')->name('getapl');
Route::get('getListAplGrpByCity/{country}', 'IndexController@getListAplGrpByCity')->name('getListAplGrpByCity');

// Shop and Product
Route::post('shop/search', 'SearchController@search')->name('c.search');
Route::get('shop/search', 'SearchController@search')->name('cg.search');
Route::get('shop/search/remove', 'SearchController@removeSearch')->name('remove.search');
Route::get('shop/search/save', 'SearchController@saveSearch')->name('save.search');
Route::post('shop/{category?}', 'SearchController@index')->name('search');
Route::get('shop/{category?}', 'ShopController@index')->name('shop.index');// List product by Category OR no
Route::get('product/{slug}', 'ProductController@index')->name('product.index');// View Product
Route::get('get/show/product/{slug}', 'ProductController@getShowProduct')->name('get.show.product');

Route::get('mes-programmes', 'ProductController@mesProgramme')->name('mes-programmes');
Route::get('nouveau-programmes', 'ProductController@nouveauProgrammes')->name('nouveau-programmes');
Route::post('ajaxGetTypeProduitCategorie', 'ProductController@ajaxGetTypeProduitCategorie')->name('ajaxGetTypeProduitCategorie');
Route::post('ajaxDropZone', 'ProductController@ajaxDropZone')->name('ajaxDropZone'); 
Route::get('ajaxCheckTitreProgramme', 'ProductController@ajaxCheckTitreProgramme')->name('ajaxCheckTitreProgramme');
Route::post('ajaxDropZoneEdit', 'ProductController@ajaxDropZoneEdit')->name('ajaxDropZoneEdit');  
Route::post('AjaxFonDossierEdit', 'ProductController@AjaxFonDossierEdit')->name('AjaxFonDossierEdit'); 
Route::post('ajaxChangeIconPhotoActive', 'ProductController@ajaxChangeIconPhotoActive')->name('ajaxChangeIconPhotoActive');
Route::post('ajaxDropPhotoIcon', 'ProductController@ajaxDropPhotoIcon')->name('ajaxDropPhotoIcon');
Route::post('ajaxGetProductById', 'ProductController@ajaxGetProductById')->name('ajaxGetProductById');  
Route::post('ajaxSaveProduct', 'ProductController@ajaxSaveProduct')->name('ajaxSaveProduct');
Route::post('ajaxModifProduct', 'ProductController@ajaxModifProduct')->name('ajaxModifProduct');
Route::post('ajaxDropProduit', 'ProductController@ajaxDropProduit')->name('ajaxDropProduit');  
Route::get('ajaxCheckFirb', 'ProductController@ajaxCheckFirb')->name('ajaxCheckFirb'); 
Route::post('save-programme', 'ProductController@saveProgramme')->name('save-programme');  
Route::get('edit-programme/{product}', 'ProductController@editProgramme')->name('edit.programme'); 
Route::get('produit-programme/{product}', 'ProductController@produitProgramme')->name('produit.programme'); 
Route::post('updateProgramme', 'ProductController@updateProgramme')->name('updateProgramme');
Route::get('mes-produits', 'ProductController@mesProduits')->name('mes-produits'); 
Route::get('nouveau-produit', 'ProductController@nouveauProduit')->name('nouveau-produit');
Route::post('save-product', 'ProductController@saveProduct')->name('save-product'); 
Route::post('ajaxDropFondDossier', 'ProductController@ajaxDropFondDossier')->name('ajaxDropFondDossier'); 
Route::post('ajaxDropZoneDeleteFile', 'ProductController@ajaxDropZoneDeleteFile')->name('ajaxDropZoneDeleteFile'); 
// Programme
Route::get('programmes/{filter?}', 'ProgrammeController@all')->name('programme.all');// List programme by filter OR no
Route::get('get/show/programme/{slug}', 'ProgrammeController@getShowProgramme')->name('get.show.programme');
Route::get('programme/{slug?}', 'ProgrammeController@show')->name('programme.show');// View single program

/// Blog
Route::get('blogs/{filter?}', 'BlogController@all')->name('blog.all');
Route::get('blogs/show/random/{filter?}', 'BlogController@allRandom')->name('blog.all.random');
Route::get('blog/{slug}', 'BlogController@index')->name('blog.index');

// Contact Page
Route::get('contact','MailController@contact');
Route::post('contact','MailController@contact')->name('contact');
Route::post('newsletter','MailController@saveNewsletter')->name('newsletter.store');

Route::post('sendmail', 'SendMailController@sendMail')->name('sendmail');

// Register
Route::middleware('guest')->group(function(){
    Route::get('register/{role}', 'Auth\RegisterController@index')->name('register');
    // Route::post('register/{role}', 'Auth\RegisterController@register');
    Route::get('register/{role}/show', 'Auth\RegisterController@register')->name('register.show');
    Route::post('register/{role}/store', 'Auth\RegisterController@store')->name('register.store');
    Route::get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
    Route::get('resend-code/{user}', 'Auth\RegisterController@resendActivation')->name('resend_code');
    Route::post('login/sellerByAfa', 'Auth\LoginController@loginSellerByAfa')->name('login.sellerbyafa');
});

Route::middleware(["auth"])->group(function(){
    // Notification
    Route::get('notifications/{filter?}', 'NotificationController@all')->name('notification.list');

    //Chat
    Route::get('chat', 'ChatController@index');
    Route::post('chat/threads', 'ThreadController@store');
    Route::post('chat/messages', 'ChatController@store');

    // Label
    Route::get('product/{product}/label/{type}', 'LabelController@storeOrUpdate')->name('label.store');// Save OR Star Product
    Route::get('product/label/{id}', 'LabelController@remove')->name('label.remove');// Remove Star Product
    Route::get('products/label/{type}', 'LabelController@all')->name('label.list');// List saved products OR starred Product

    // Subscription Plan
    Route::get('/plans', 'PlanController@index')->name('plans');
    Route::get('/plan/{plan}', 'PlanController@show')->name('plan.show');
    Route::post('/subscribe', 'PlanController@subscribe')->name('subscribe');
    Route::post('/subscription/success', 'SubscriptionController@success')->name('subscription.success');

    // Profile
    Route::prefix('profile')->group(function(){
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('edit', 'ProfileController@profile')->name('profile.edit');
        Route::post('edit', 'ProfileController@editProfile');
        Route::get('password', 'ProfileController@password')->name('password.edit');
        Route::post('password', 'ProfileController@updatePassword')->name('password.update');;
        Route::get('avatar', 'ProfileController@avatar')->name('avatar.edit');
        Route::post('avatar', 'ProfileController@updateAvatar');
        Route::get('location', 'ProfileController@location')->name('location.edit');
        Route::post('location', 'ProfileController@updateLocation');
    });

    Route::post('search', 'SearchController@edit')->name('search.edit');
    Route::post('search/delete', 'SearchController@delete')->name('search.delete');
    Route::post('comment/store', 'BlogController@storeComment')->name('comment.store');

});


Route::middleware(["auth", "role:5"])->group(function(){
    // Buy product
    Route::post('product/{product}', 'ShopController@order')->name('shop.order');
    Route::get('product/{product}/apl', 'ShopController@selectApl')->name('shop.select.apl');

    Route::get('order/last', 'ShopController@lastOrder')->name('shop.order.last');
    Route::post('order/last', 'ShopController@cancel');

    Route::get('checkout', 'ShopController@getCheckout')->name('shop.checkout');
    Route::post('checkout', 'ShopController@postCheckout');

    Route::prefix('member')->group(function(){

        Route::get('select-apl', 'MemberController@selectApl')->name('member.select.apl');
        Route::post('select-apl', 'MemberController@updateApl');

        Route::get('select-afa', 'MemberController@selectAfa')->name('member.select.afa');
        Route::get('contact-afa', 'MemberController@contactAfa')->name('member.contact.afa');
        Route::post('select-afa', 'MemberController@updateAfa');
        Route::get('go-there', 'MemberController@goThere')->name('member.go.there');
        Route::get('send-courriel', 'MemberController@sendCourriel')->name('member.send.courriel');

        Route::get('/', 'BackendController@dashboard');
        Route::get('favorites', 'BackendController@favorites');
        Route::get('pins', 'BackendController@pins');
        Route::get('searches', 'BackendController@searches');

        Route::get('contact/role/{role}', 'MemberController@contact')->name('member.contact');
        // Route::post('contact/{role}', 'MemberController@sendMessage')->name('member.send.message');
        // Route::get('contact/{role}/messages', 'MemberController@getAllMessage')->name('member.get.message');
        // Route::get('contact/messages/unread', 'MemberController@getUnreadMessage')->name('member.get.unread.message');
        Route::post('contact/role/{role}', 'MemberController@sendMail')->name('member.send.mail');

        Route::get('carts', 'MemberController@carts')->name('member.carts');
        Route::get('orders', 'MemberController@orders')->name('member.orders');
        Route::get('purchases', 'MemberController@purchases')->name('member.purchases');
        Route::get('sale/{sale}', 'SaleController@show')->name('member.cart');

        Route::get('contact/{user}' , 'BackendController@contact')->name('member.user.contact');
        Route::post('contact/{user}', 'BackendController@postContact');
        
        //testimonial
        Route::get('testimonial', 'MemberController@testimonial')->name('member.testimonial');
        Route::post('ajaxSaveTestimonial', 'MemberController@ajaxSaveTestimonial')->name('member.ajaxSaveTestimonial');
        Route::post('ajaxGetTestimonialById', 'MemberController@ajaxGetTestimonialById')->name('ajaxGetTestimonialById');
        Route::post('ajaxModifTestimonial', 'MemberController@ajaxModifTestimonial')->name('ajaxModifTestimonial');
        Route::post('ajaxDropTestimonial', 'MemberController@ajaxDropTestimonial')->name('ajaxDropTestimonial'); 
        
        Route::get('relationApl', 'MemberController@relationApl')->name('member.relationApl');
        Route::post('ajaxDropRelation', 'MemberController@ajaxDropRelation')->name('member.ajaxDropRelation');
        Route::post('ajaxRenewRelation', 'MemberController@ajaxRenewRelation')->name('member.ajaxRenewRelation');

        // Mail Controller Groups
        Route::get('mails/{filter?}', 'MailController@all')->name('member.mail.list');
        Route::prefix('mail')->group(function(){
            Route::get('{mail}', 'MailController@view')->name('member.mail.index');
            Route::get('delete/{mail}', 'MailController@delete')->name('member.mail.delete');
        });
    });

});

Route::prefix('apl')->middleware(["auth","role:4"])->group(function(){

    Route::get('/', 'BackendController@dashboard');
    Route::get('favorites', 'BackendController@favorites');
    Route::get('pins', 'BackendController@pins');
    Route::get('searches', 'BackendController@searches');

    Route::get('orders', 'AplController@orders')->name('apl.orders');
    Route::get('sales', 'AplController@sales')->name('apl.sales');
    Route::get('customers', 'AplController@customers')->name('apl.customers');
    Route::get('commissions/{filter?}', 'AplController@commissions')->name('apl.commissions');
    Route::get('cartitem/{cartitem}', 'CartItemController@show')->name('apl.cartitem.show');

    Route::get('contact/{user}' , 'BackendController@contact')->name('apl.user.contact');
    Route::post('contact/{user}', 'BackendController@postContact');

    // Mail Controller Groups
    Route::get('mails/{filter?}', 'MailController@all')->name('apl.mail.list');
    Route::prefix('mail')->group(function(){
        Route::get('{mail}', 'MailController@view')->name('apl.mail.index');
        Route::get('delete/{mail}', 'MailController@delete')->name('apl.mail.delete');
    });

    Route::get('message/{role}/show', 'AplController@showMessage')->name('apl.show.message');

});

Route::prefix('afa')->middleware(["auth","role:3"])->group(function(){

    Route::get('/', 'BackendController@dashboard');
    Route::get('favorites', 'BackendController@favorites');
    Route::get('pins', 'BackendController@pins');
    Route::get('searches', 'BackendController@searches');

    Route::get('orders', 'AfaController@orders')->name('afa.orders');
    Route::get('sales', 'AfaController@sales')->name('afa.sales');
    Route::get('commissions/{filter?}', 'AfaController@commissions')->name('afa.commissions');
    Route::get('cartitem/{cartitem}', 'CartItemController@show')->name('afa.cartitem.show');

    Route::get('contact/{user}' , 'BackendController@contact')->name('afa.user.contact');
    Route::post('contact/{user}', 'BackendController@postContact');

    // Mail Controller Groups
    Route::get('mails/{filter?}', 'MailController@all')->name('afa.mail.list');
    Route::prefix('mail')->group(function(){
        Route::get('{mail}', 'MailController@view')->name('afa.mail.index');
        Route::get('delete/{mail}', 'AfaController@delete')->name('afa.mail.delete');
    });

    Route::get('message/{role}/show', 'AfaController@showMessage')->name('afa.show.message');
});

Route::prefix('seller')->middleware(["auth","role:2"])->group(function(){

    Route::get('/', 'BackendController@dashboard');
    Route::get('favorites', 'BackendController@favorites');
    Route::get('pins', 'BackendController@pins');
    Route::get('searches', 'BackendController@searches');

    Route::get('products', 'SellerController@products')->name('seller.products');
    Route::get('sales', 'SellerController@sales')->name('seller.sales');
    Route::get('orders', 'SellerController@orders')->name('seller.orders');
    Route::get('cartitem/{cartitem}', 'CartItemController@show')->name('seller.cartitem.show');

    Route::get('contact/{user}' , 'BackendController@contact')->name('seller.user.contact');
    Route::post('contact/{user}', 'BackendController@postContact');

    // Mail Controller Groups
    Route::get('mails/{filter?}', 'MailController@all')->name('seller.mail.list');
    Route::prefix('mail')->group(function(){
        Route::get('{mail}', 'MailController@view')->name('seller.mail.index');
        Route::get('delete/{mail}', 'MailController@delete')->name('seller.mail.delete');
    });

});


Route::middleware(["auth", "role:5"] || ["auth", "role:3"])->group(function(){

    Route::post('message/{role}', 'MessageController@sendMessage')->name('send.message');
    Route::get('message/get_all/{role}', 'MessageController@getAllMessage')->name('get.message');
    Route::get('message/unread/{user_id}', 'MessageController@getUnreadMessage')->name('get.unread.message');
    Route::get('message/list/contact', 'MessageController@getListContactMessage')->name('get.list.contact.message');
    Route::get('message/all/contact/unread/', 'MessageController@getUnreadCountMessageContact')->name('get.unread.count.message.contact');
    Route::get('message/show/{to_id}', 'MessageController@showContactMessage')->name('show.contact.message');
    Route::post('message/contact', 'MessageController@sendContactMessage')->name('send.contact.message');

});


Route::get('translation/{lang}/{text}', function ($lang,$text) {
    return getGTranslateTest($lang,$text);
});

Route::get('checkout', array('as' => 'paypal.paypalwithpayments','uses' => 'Paypal@payWithPaypal',)); 
Route::post('paypal', array('as' => 'paypal.paypal','uses' => 'Paypal@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'payment.status','uses' => 'Paypal@getPaymentStatus',));



