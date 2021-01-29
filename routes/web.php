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

Route::get('/langue', [
    'as' => 'editlangue',
    'uses' => 'IndexController@editlangue',
]);

Route::get('home/modal/step/{val}','IndexController@homestepmodal')->name('homestepmodal');

Route::get('mail/basic','MailController@basic_email');
Route::get('mail/html','MailController@html_email');
Route::get('mail/attachment','MailController@attachment_email');


Auth::routes();
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//Open Mail
Route::get('mail/read/{mailuser}', 'MailController@read');

// Localisation
Route::get('localization/{locale}', 'LocalizationController@index')->name('localization');

// Static pages
Route::get('/', 'IndexController@index')->name('home');
Route::get('services', 'IndexController@services')->name('services');
Route::get('terms', 'IndexController@terms')->name('terms');
Route::get('help', 'IndexController@help')->name('help');
Route::get('publicities', 'IndexController@publicities')->name('publicities');
Route::get('confidentialities', 'IndexController@confidentialities')->name('confidentialities');
Route::get('apls', 'IndexController@apl')->name('apls');

// Blog
Route::get('blogs/{filter?}', 'BlogController@all')->name('blog.all');
Route::get('blog/{slug}', 'BlogController@index')->name('blog.index');

// Comment
Route::get('comments/{blog}', 'CommentController@index');
Route::post('comments', 'CommentController@store');
Route::post('comments/{comment}/{action}', 'CommentController@update');

// Shop and Product
Route::post('shop/{category?}', 'SearchController@index')->name('search');
Route::get('shop/{category?}', 'ShopController@index')->name('shop.index');// List product by Category OR no
Route::get('product/{slug}', 'ProductController@index')->name('product.index');// View Product

// Baintree
Route::post('braintree/webhook', 'WebhookController@handleWebhook');
Route::get('braintree/token', 'BraintreeController@token')->name('braintree.token');

// Chart
Route::get('api/chart/categories', 'ChartController@categories')->name('chart.categories');
Route::get('api/chart/locations/{type?}', 'ChartController@locations')->name('chart.locations');
Route::get('api/chart/prices', 'ChartController@prices')->name('chart.prices');
Route::get('api/chart/sellers', 'ChartController@sellers')->name('chart.sellers');
Route::get('api/chart/dates/{role?}', 'ChartController@dates')->name('chart.dates');
Route::get('api/chart/carts', 'ChartController@carts')->name('chart.carts');

// Register
Route::middleware('guest')->group(function(){
    Route::get('register/{role}', 'Auth\RegisterController@index')->name('register');
    Route::post('register/{role}', 'Auth\RegisterController@register');
    Route::get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
    Route::get('resend-code/{user}', 'Auth\RegisterController@resendActivation')->name('resend_code');
});

// Contact Page
Route::get('contact','MailController@contact');
Route::post('contact','MailController@contact')->name('contact');

Route::middleware(["auth"])->group(function(){
    // Notification
    Route::get('notifications/{filter?}', 'NotificationController@all')->name('notification.list');

    //Chat
    Route::get('chat', 'ChatController@index');
    Route::post('chat/threads', 'ThreadController@store');
    Route::post('chat/messages', 'ChatController@store');

    // Label
    Route::get('product/{product}/label/{type}', 'LabelController@storeOrUpdate')->name('label.store');// Save OR Star Product
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
        Route::post('password', 'ProfileController@updatePassword');
        Route::get('avatar', 'ProfileController@avatar')->name('avatar.edit');
        Route::post('avatar', 'ProfileController@updateAvatar');
        Route::get('location', 'ProfileController@location')->name('location.edit');
        Route::post('location', 'ProfileController@updateLocation');
    });
    
    Route::post('search', 'SearchController@edit')->name('search.edit');
    Route::post('search/delete', 'SearchController@delete')->name('search.delete');

});


Route::middleware(["auth", "role:member"])->group(function(){
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

        Route::get('/', 'BackendController@dashboard');
        Route::get('favorites', 'BackendController@favorites');
        Route::get('pins', 'BackendController@pins');
        Route::get('searches', 'BackendController@searches');
        
        Route::get('contact/role/{role}', 'MemberController@contact')->name('member.contact');
        Route::post('contact/role/{role}', 'MemberController@sendMail');
        
        Route::get('carts', 'MemberController@carts')->name('member.carts');
        Route::get('orders', 'MemberController@orders')->name('member.orders');
        Route::get('purchases', 'MemberController@purchases')->name('member.purchases');
        Route::get('sale/{sale}', 'SaleController@show')->name('member.cart');
        
        Route::get('contact/{user}' , 'BackendController@contact')->name('member.user.contact');
        Route::post('contact/{user}', 'BackendController@postContact');
        
        // Mail Controller Groups
        Route::get('mails/{filter?}', 'MailController@all')->name('member.mail.list');
        Route::prefix('mail')->group(function(){
            Route::get('{mail}', 'MailController@view')->name('member.mail.index');
            Route::get('delete/{mail}', 'MailController@delete')->name('member.mail.delete');
        });
    });
    
});

Route::prefix('afa')->middleware(["auth","role:afa"])->group(function(){
    
    Route::get('/', 'BackendController@dashboard');
    Route::get('favorites', 'BackendController@favorites');
    Route::get('pins', 'BackendController@pins');
    
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
        Route::get('delete/{mail}', 'MailController@delete')->name('afa.mail.delete');
    });
    
});

Route::prefix('apl')->middleware(["auth","role:apl"])->group(function(){
    
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
    
});

Route::prefix('seller')->middleware(["auth","role:seller"])->group(function(){
    
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



// Route FrontOffice V2
/* ---------- ROUTE V2 ------------------*/
Route::prefix('V2')->namespace('V2')->as('v2.')->group(function(){
    // Static pages
    Route::get('/', 'IndexController@index')->name('home');
    Route::get('services', 'IndexController@services_v2')->name('services');
    Route::get('terms', 'IndexController@terms_v2')->name('terms');
    Route::get('help', 'IndexController@help_v2')->name('help');
    Route::get('publicities', 'IndexController@publicities_v2')->name('publicities');
    Route::get('confidentialities', 'IndexController@confidentialities_v2')->name('confidentialities');
    Route::get('apls', 'IndexController@apl')->name('apls');

    // Shop and Product
    Route::post('shop/{category?}', 'SearchController@index')->name('search');
    Route::get('shop/{category?}', 'ShopController@index')->name('shop.index');// List product by Category OR no
    Route::get('product/{slug}', 'ProductController@index')->name('product.index');// View Product

    /// Blog
    Route::get('blogs/{filter?}', 'BlogController@all')->name('blog.all');
    Route::get('blog/{slug}', 'BlogController@index')->name('blog.index');

    // Contact Page
    Route::get('contact','MailController@contact');
    Route::post('contact','MailController@contact')->name('contact');

    // Auth
    Route::get('login', 'IndexController@login')->name('login');

    // Register
    Route::middleware('guest')->group(function(){
        Route::get('register/{role}', 'Auth\RegisterController@index')->name('register');
        Route::post('register/{role}', 'Auth\RegisterController@register');
        Route::get('verify-user/{code}', 'Auth\RegisterController@activateUser')->name('activate.user');
        Route::get('resend-code/{user}', 'Auth\RegisterController@resendActivation')->name('resend_code');
    });
});