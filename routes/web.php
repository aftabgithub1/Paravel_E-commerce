<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
   
// Login with Social media
Route::get('login/github', 'Auth\LoginController@redirectToProvider');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback'); 
    
// Frontend page 
Route::get('/', 'FrontendController@Home')->name('home');
Route::get('/contact', 'FrontendController@contact');
Route::get('/about', 'FrontendController@about');
Route::get('/faq', 'FrontendController@faq');
Route::get('/shop', 'FrontendController@shop');
Route::get('/blog-page', 'FrontendController@blogPage');
Route::get('/blog-details/{blog_id}', 'FrontendController@blogDetails');
Route::post('/blog-comment-post', 'FrontendController@blogCommentPost')->middleware('verified');
Route::get('/login-same-page/{blog_id}', 'FrontendController@loginSamePage');
Route::get('/search', 'FrontendController@search');
Route::get('/send-email', 'FrontendController@sendEmail');

// Frontend Elements
Route::resource('/frontend-elements', 'FrontendElementController');

// Cart Controller
Route::post('/add-to-cart', 'CartController@addToCart');
Route::post('/add-to-cart-single', 'CartController@addToCartSingle');
Route::get('/delete-cart/{cart_id}', 'CartController@deleteCart');
Route::get('/shoping_cart', 'CartController@shopingCart');
Route::post('/update-cart', 'CartController@updateCart');
Route::get('/shoping_cart/{coupon_name}', 'CartController@shopingCart');  

// Wishlist Controller
Route::match(['get', 'post'], '/wishlist', 'WishlistController@wishlist');
Route::post('/add-to-wishlist', 'WishlistController@addToWishlist');
Route::post('/wishlist-to-cart', 'WishlistController@wishlistToCart');
Route::get('/delete-wishlist/{wishlist_id}', 'WishlistController@deleteWishlist');


Route::post('/checkout', 'CheckoutController@checkout');
Route::post('/checkout-post', 'CheckoutController@checkoutPost');
Route::get('/get-city-list', 'CheckoutController@getCityList');

Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

Route::post('add-review', 'FrontendController@addReview');

    
// Dashboard Starts
Route::get('/my-account', 'DashboardController@myAccount');



// Admin pannel
Route::get('/admin-dashboard', 'DashboardController@adminDashboard')->name('admin-dashboard');

Route::get('/users', 'DashboardController@users')->name('users');
Route::get('/useredit/{user_id}', 'DashboardController@userEdit');
Route::post('/usereditpost', 'DashboardController@userEditPost');

Route::get('/editprofile', 'DashboardController@editprofile');
Route::post('/editprofilepost', 'DashboardController@editprofilepost');

Route::get('/userdelete/{user_id}', 'DashboardController@userDelete');

// User Role
Route::get('/role', 'RoleController@roleManager');
Route::post('/add-permission', 'RoleController@addPermission');
Route::post('/add-role', 'RoleController@addRole');
Route::post('/assign-role', 'RoleController@assignRoleToUser');
Route::get('/edit-user-role/{user_id}', 'RoleController@editUserRole');
Route::post('/update-user-permission', 'RoleController@updateUsrePermission');

// Edit Profile Controller
Route::get('/user-profile', 'EditProfileController@userProfile');
Route::post('/edit-name', 'EditProfileController@editName');
Route::post('/edit-email', 'EditProfileController@editEmail');
Route::post('/edit-image', 'EditProfileController@editImage');
Route::post('/edit-password', 'EditProfileController@editPassword');


// Blog Pannel
Route::resource('/blog', 'BlogController');

// API
Route::get('/api-movies', 'ApiController@movies');


// Customer Pannel
Route::get('/customer-dashboard', 'CustomerController@customerDashboard')->name('customer-dashboard');
Route::get('/customer-order', 'CustomerController@customerOrder');
Route::get('/download-pdf/{order_id}', 'CustomerController@downloadPdf');
Route::get('/send-sms/{send_sms}', 'CustomerController@sendSms');


// All FAQ Routes
Route::get('/addfaq', 'DashboardController@addfaq');
Route::post('/addfaqpost', 'DashboardController@addfaqpost');

Route::get('/faqdelete/{faqs_id}', 'DashboardController@faqdelete');

Route::get('/faqedit/{faqs_id}', 'DashboardController@faqedit');
Route::post('/editFaqPost', 'DashboardController@editFaqPost');



// Category
Route::resource('/category', 'CategoryController');
Route::get('categorydelete/{ctg_id}', 'CategoryController@categoryDelete');

// Product
Route::resource('/product', 'ProductController');

// Coupon
Route::resource('/coupon', 'CouponController');






// TRASH
Route::get('/usertrash', 'TrashController@userTrash');
Route::get('/userrestore/{user_id}', 'TrashController@userRestore');
Route::get('/userforcedelete/{user_id}', 'TrashController@userForceDelete');

Route::get('/faqtrash', 'TrashController@faqTrash');
Route::get('/faqrestore/{faqs_id}', 'TrashController@faqRestore');
Route::get('/faqforcedelete/{faqs_id}', 'TrashController@faqForceDelete');

Route::get('/categorytrash', 'TrashController@categoryTrash');
Route::get('/categoryrestore/{ctg_id} ', 'TrashController@categoryRestore');
Route::get('/categoryforcedelete/{ctg_id} ', 'TrashController@categoryForceDelete');


