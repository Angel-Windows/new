<?php
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

// шаблоны (иначе недопустимо)
Route::pattern('id', '[0-9]+');
Route::pattern('page_type', '(main|other|bay|catalog)');
Route::pattern('ord_type', '(new|taken|made)');
Route::pattern('page_url', '[0-9a-z-_]+');

Route::get('/editStaff/{id}', [
    'as' => 'getCopy', 'uses' => 'Admin\AdminStaffController@getCopy'
]); // роут для работы с функцией копирования записей

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {

    Route::get('/', 'Admin\AdminHomeController@index');
    Route::get('/products_management', 'Admin\AdminProductsController@productsManagement');
    Route::get('/feedback_management', 'Admin\AdminFeedbackController@feedbackTypes');

    // страницы
    Route::get('/pages/{page_type}', 'Admin\AdminPageController@pagesCategories');
    Route::post('/pages/{page_type}', 'Admin\AdminPageController@actionPost');
    Route::get('pages/{page_type}/edit/{id}', 'Admin\AdminPageController@editPost');
    Route::post('pages/{page_type}/edit/{id}', 'Admin\AdminPageController@postEdit');
    Route::get('pages/{page_type}/add', 'Admin\AdminPageController@getAdd');
    Route::post('pages/{page_type}/add', 'Admin\AdminPageController@postAdd');
    Route::post('slide_text', 'Admin\AdminSliderController@postSlideText');

    Route::controllers([
        'pages' => 'Admin\AdminPageController',
        'offers' => 'Admin\AdminOffersController',
        'staff' => 'Admin\AdminStaffController',
        'delivery' => 'Admin\AdminDeliveryController',
        'payment' => 'Admin\AdminPaymentController',
        'links' => 'Admin\AdminLinksController',
        'news' => 'Admin\AdminNewsController',
        'slider' => 'Admin\AdminSliderController',
        'feedback' => 'Admin\AdminFeedbackController',
        'users' => 'Admin\AdminUsersController',
        'categories' => 'Admin\AdminCategoriesController',
        'brands' => 'Admin\AdminBrandsController',
        'products' => 'Admin\AdminProductsController',
        'settings' => 'Admin\AdminSettingsController',
        'orders' => 'Admin\AdminOrdersController',
        'subscrib' => 'Admin\AdminSubscribeController',
        'features' => 'Admin\AdminFeaturesController',
        'option_variants' => 'Admin\AdminOptionVariantsController',
        'pointers' => 'Admin\AdminPointerController',
        'notifications' => 'Admin\AdminNotificationsController',
        'charlist' => 'Admin\AdminCharlistController',
        'charlist_option_variants' => 'Admin\AdminCharlistOptionVariantsController',
        'product_reviews' => 'Admin\AdminProductReviewsController'
    ]);
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//поставить на cron каждый день
Route::get('/cronNotification', 'Frontend\NotificationController@index');

Route::group([
    'prefix' => \LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function () {
    Route::get('/', 'Frontend\HomeController@index');

    // NEWS
    Route::get('/news', 'Frontend\NewsController@index');
    Route::get('/news/{page_url}', 'Frontend\NewsController@getNews');

    // CATALOG
    Route::get('/category', 'Frontend\CategoriesController@getOpenCat');
    Route::any('/category/{page_url}', 'Frontend\CategoriesController@getProducts');
    Route::post('/change-toggle', 'Frontend\CategoriesController@changeToggle');

    Route::get('poshuk','Frontend\Search@search')->name('search');

    //product
    Route::get('/product/{page_url}', 'Frontend\ProductController@showProduct')->name('product');

    //register
    Route::get('/reg', 'Frontend\PersonalAreaController@getRegister');

    //BRANDS
    Route::get('/brand/{page_url}', 'Frontend\PageController@getBrand');

    //contacs
    Route::get('/contacts', 'Frontend\PageController@getContacts');

    //cabinet
    Route::get('/personal-area', 'Frontend\PersonalAreaController@index');
    Route::get('/edit-info', 'Frontend\PersonalAreaController@getEditInfo');
    Route::get('/notifications', 'Frontend\PersonalAreaController@notifications');

    Route::controllers([
        'service' => 'Frontend\ServiceController'
    ]);

    //cart
    Route::get('/cart', 'Frontend\CartController@getCart');
    Route::get('/cartStepTwo', 'Frontend\CartController@getCartStepTwo');
    Route::get('/cartStepThree', 'Frontend\CartController@carStepThreeNew')->name('cartThree');

    Route::get('/{page_url}', 'Frontend\PageController@index');

});
// QUICK ORDER 
Route::post('/quick_order', 'Frontend\CartController@quickOrder');

//cabinet
//Route::get('/personal-area', 'Frontend\PersonalAreaController@index');
Route::post('/login', 'Frontend\PersonalAreaController@postLogin');

Route::get('/logout', 'Frontend\PersonalAreaController@logout');

Route::post('/edit-info', 'Frontend\PersonalAreaController@postEditInfo');


Route::post('/notifications', 'Frontend\PersonalAreaController@postNotifications');

Route::post('/search', 'Frontend\BaseController@search');


// PRODUCTS

Route::post('/add_review', 'Frontend\ProductController@postAddReviews');
Route::post('/update_reviews_rating', 'Frontend\ProductController@postUpdateReviewsRating');
Route::post('/add_to_favorite', 'Frontend\ProductController@postAddToFavorite');

// COMPARE
Route::get('/compare', 'Frontend\CompareController@showCompare');
Route::get('/compare/{page_url}', 'Frontend\CompareController@getCompare');
Route::post('/to_compare', 'Frontend\CompareController@addToCompare');
Route::post('/remove-from-compare', 'Frontend\CompareController@removeFromCompare');

// Подписка
Route::post('/send_sub', 'Frontend\BaseController@SubscribePost');

Route::post('/setShowProducts', 'Frontend\BaseController@setShow');

//CART
Route::post('/cartCharlist', 'Frontend\CartController@prodToCart');
Route::post('/changeQuantity', 'Frontend\CartController@changeQuantity');
Route::post('/remove_from_cart', 'Frontend\CartController@removeFromCart');
Route::post('/getCharList', 'Frontend\CartController@getCharList');
Route::post('/newFeature', 'Frontend\CartController@newFeature');

Route::post('/confirmOrder', 'Frontend\CartController@confirmOrder');
Route::post('/sendRewiew', 'Frontend\BaseController@sendRewiew');
Route::post('/cartStepTwo', 'Frontend\CartController@postCartStepTwo');

//google
Route::get('/google-auth', 'Frontend\SocialsAuthController@authGoogle');
//facebook
Route::get('/facebook-auth', 'Frontend\SocialsAuthController@authFacebook');

//register
Route::post('/register', 'Frontend\PersonalAreaController@postRegister');

Route::post('/tocart', 'Frontend\CartController@toCart');
//Route::post('/change_quantity', 'Frontend\CartController@changeQuantity');
Route::post('/change_delivery', 'Frontend\CartController@changeDelivery');
Route::post('/change_payment', 'Frontend\CartController@changePayment');
Route::post('/checkout', 'Frontend\CartController@fullOrder');

//Offers
Route::get('/offers', 'Frontend\OffersController@index');
Route::get('/offers/{page_url}', 'Frontend\OffersController@getOffers');

//LiqPay
Route::post('/pay', 'Frontend\CartController@payedServer')->name('server-pay');
Route::get('/pay', 'Frontend\CartController@payedResult')->name('result-pay');

//Google Sheet
Route::get('/google-sheet', 'Frontend\GoogleSheetController@get');
Route::get('/google-sheet-generate', 'Frontend\GoogleSheetController@generate');

/* Profile
-----------------------------------------------------------------------------------*/
/*---------------------------------------------------------------------------------*/
Route::post('/feedback', 'Frontend\BaseController@feedback');

Route::get('clear', function () {
    Log::debug('CLEARED');
    Artisan::call('cache:clear');
});
