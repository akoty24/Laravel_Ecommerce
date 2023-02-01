<?php
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\admin\auth\RegisterController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\Admin\Team_MemberController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\FrontendController;
use App\Http\Controllers\front\WishlistController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/home',[IndexController::class,'home'])->name('home');
Route::get('/search',[FrontendController::class,'search'])->name('search');
Route::get('/shop', [FrontendController::class,'shop'])->name('shop');
Route::get('product_detail/{category_id}',[FrontendController::class,'product_detail'])->name('product.detail');
Route::get('/about', [FrontendController::class,'about_us'])->name('about');
Route::get('/contact', [FrontendController::class,'contact_us'])->name('contact');


 // Auth For Admin And User Routes
Route::group(['prefix' => 'Auth'], function (){
    Route::get('login',[LoginController::class,'Login_and_register_page'])->name('register.and.login');
    Route::post('login',[LoginController::class,'Login'])->name('login');
    Route::post('register',[RegisterController::class, 'Register'])->name('register');
    Route::get('logout',[RegisterController::class,'logout'])->name('logout');
});
// Admin Routes
Route::middleware(['auth','auth.admin'])->group(callback: function () {
//dashboard
Route::get('admin_dashboard',[IndexController::class,'Admin_Dashboard'])->name('admin.dashboard');
//slider
Route::group(['prefix' => 'slider'], function () {
    Route::get('/',[SliderController::class,'index'])->name('admin.slider');
    Route::get('create',[SliderController::class,'create'])->name('admin.slider.create');
    Route::post('store',[SliderController::class,'store'])->name('admin.slider.store');
    Route::get('edit/{id}',[SliderController::class,'edit'])->name('admin.slider.edit');
    Route::post('update/{id}',[SliderController::class,'update'])->name('admin.slider.update');
    Route::get('show/{id}',[SliderController::class,'show'])->name('admin.slider.show');
    Route::get('delete/{id}',[SliderController::class,'delete'])->name('admin.slider.delete');

});
//banner
Route::group(['prefix' => 'banner'], function () {
        Route::get('/',[BannerController::class,'index'])->name('admin.banner');
        Route::get('create',[BannerController::class,'create'])->name('admin.banner.create');
        Route::post('store',[BannerController::class,'store'])->name('admin.banner.store');
        Route::get('edit/{id}',[BannerController::class,'edit'])->name('admin.banner.edit');
        Route::get('show/{id}',[BannerController::class,'show'])->name('admin.banner.show');
        Route::post('update/{id}',[BannerController::class,'update'])->name('admin.banner.update');
        Route::get('delete/{id}',[BannerController::class,'delete'])->name('admin.banner.delete');

    });
//category
Route::group(['prefix' => 'category'], function () {
    Route::get('/',[CategoryController::class,'index'])->name('admin.category');
    Route::get('create',[CategoryController::class,'create'])->name('admin.category.create');
    Route::post('store',[CategoryController::class,'store'])->name('admin.category.store');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
    Route::post('update/{id}',[CategoryController::class,'update'])->name('admin.category.update');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
    Route::get('status/{id}',[CategoryController::class,'status'])->name('admin.category.status');

});
//product
Route::group(['prefix' => 'product'], function () {
    Route::get('/',[ProductController::class,'index'])->name('admin.product');
    Route::get('create',[ProductController::class,'create'])->name('admin.product.create');
    Route::post('store',[ProductController::class,'store'])->name('admin.product.store');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('admin.product.edit');
    Route::post('update/{id}',[ProductController::class,'update'])->name('admin.product.update');
    Route::get('show/{id}',[ProductController::class,'show'])->name('admin.product.show');
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('admin.product.delete');
    Route::get('status/{id}',[ProductController::class,'status'])->name('admin.product.status');

});
//Review
Route::group(['prefix' => 'review'], function () {
    Route::get('/',[\App\Http\Controllers\Admin\ReviewController::class,'index'])->name('admin.review');
    Route::get('show/{id}',[\App\Http\Controllers\Admin\ReviewController::class,'show'])->name('admin.review.show');
    Route::get('delete/{id}',[\App\Http\Controllers\Admin\ReviewController::class,'delete'])->name('admin.review.delete');
    });
//order
Route::group(['prefix' => 'order'], function () {
        Route::get('/',[OrderController::class,'index'])->name('admin.order');
        Route::get('show/{id}',[OrderController::class,'show'])->name('admin.order.show');
        Route::get('delete/{id}',[OrderController::class,'delete'])->name('admin.order.delete');
        Route::get('downloadInvoice/{id}',[OrderController::class,'downloadInvoice'])->name('admin.order.download');
    });
//user
Route::group(['prefix' => 'user'], function () {
    Route::get('/',[UserController::class,'index'])->name('admin.user');
    Route::get('create',[UserController::class,'create'])->name('admin.user.create');
    Route::post('store',[UserController::class,'store'])->name('admin.user.store');
    Route::get('edit/{id}',[UserController::class,'edit'])->name('admin.user.edit');
    Route::post('update/{id}',[UserController::class,'update'])->name('admin.user.update');
    Route::get('show/{id}',[UserController::class,'show'])->name('admin.user.show');
    Route::get('delete/{id}',[UserController::class,'delete'])->name('admin.user.delete');
    Route::get('status/{id}',[UserController::class,'status'])->name('admin.user.status');
});
//team_member
Route::group(['prefix' => 'team_member'], function () {
    Route::get('/',[Team_MemberController::class,'index'])->name('admin.team_member');
    Route::get('create',[Team_MemberController::class,'create'])->name('admin.team_member.create');
    Route::post('store',[Team_MemberController::class,'store'])->name('admin.team_member.store');
    Route::get('edit/{id}',[Team_MemberController::class,'edit'])->name('admin.team_member.edit');
    Route::post('update/{id}',[Team_MemberController::class,'update'])->name('admin.team_member.update');
    Route::get('show/{id}',[Team_MemberController::class,'show'])->name('admin.team_member.show');
    Route::get('delete/{id}',[Team_MemberController::class,'delete'])->name('admin.team_member.delete');
    });
//messages
Route::group(['prefix' => 'message'], function () {
        Route::get('/',[MessageController::class,'index'])->name('admin.message');
        Route::get('show/{id}',[MessageController::class,'show'])->name('admin.message.show');
        Route::get('delete/{id}',[MessageController::class,'delete'])->name('admin.message.delete');

    });
});
// User Routes
Route::middleware(['auth'])->group(function () {
    //index
    Route::get('/', [FrontendController::class,'index'])->name('index');
    //profile
    Route::group(['prefix' => 'profile'], function (){
        Route::get('/profile', [IndexController::class,'profile'])->name('profile');
        Route::get('/edit_profile/{id}',[IndexController::class,'edit_profile'])->name('edit.profile');
        Route::post('/update_profile/{id}', [IndexController::class,'update_profile'])->name('update.profile');
    });
    //whishlist
    Route::group(['prefix' => 'wishlist'], function (){
        Route::post('add_to_wishlist/{id}', [WishlistController::class,'add_to_wishlist'])->name('add.to.wishlist');
        Route::get('show_wishlist', [WishlistController::class,'show_wishlist'])->name('show.wishlist');
        Route::get('remove_from_wishlist/{id}', [WishlistController::class,'remove_from_wishlist'])->name('remove.from.wishlist');
    });
    //cart
    Route::group(['prefix' => 'cart'], function (){
        Route::post('/add_to_cart/{id}', [CartController::class,'add_to_cart'])->name('add.to.cart');
        Route::get('/show_cart', [CartController::class,'show_cart'])->name('show.cart');
        Route::get('/remove_from_cartitem/{id}', [CartController::class,'remove_from_cart'])->name('remove.from.cart');
        Route::post('/update-cart-item', [CartController::class,'updateProduct'])->name('update.cart');
        Route::get('/load-cart-data', [CartController::class, 'cartCount']);
    });
    //checkout
    Route::group(['prefix' => 'checkout'], function (){
        Route::get('/checkout', [CheckoutController::class,'checkout'])->name('checkout');
        Route::post('/place_order', [CheckoutController::class,'place_order'])->name('place.order');
        // Route::get('/paypalprocess', [CheckoutController::class,'paypalprocess'])->name('paypalprocess');
        // Route::get('/cancel', [CheckoutController::class,'cancel'])->name('cancel');
        // Route::get('/success', [CheckoutController::class,'success'])->name('success');
    });
    //order
    Route::group(['prefix' => 'order'], function () {
        Route::get('/user_order',[FrontendController::class,'user_orders'])->name('user.order');
        Route::get('/order_show_details/{id}',[FrontendController::class,'show_order_details'])->name('order.show.details');
        Route::get('/order_update_status/{id}',[FrontendController::class,'update_order_status'])->name('order.update.satuts');

    });
    //Review
    Route::group(['prefix' => 'review'], function () {
        Route::get('/add_review/{id}',[FrontendController::class,'add_review'])->name('user.review');
        Route::post('/store_review',[FrontendController::class,'submit_review'])->name('submit.review');
    });
    //submit_contact_form
    Route::post('/send_contact_form', [FrontendController::class,'submit_contact_form'])->name('send.contact.form');
});

