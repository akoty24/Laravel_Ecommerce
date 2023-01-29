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
use App\Http\Controllers\front\profileController;
use App\Http\Controllers\front\ReviewController;
use App\Http\Controllers\front\WishlistController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;



//search
Route::get('search',[IndexController::class,'search'])->name('search');

//    $products=\App\Models\Product::where('name','like','%'.request('search').'%' )->get();


//auth for admin and user routes
Route::get('login',[LoginController::class,'getLogin'])->name('registerandlogin');
Route::post('login',[LoginController::class,'Login'])->name('login');
Route::post('register',[RegisterController::class, 'Register'])->name('register');
Route::get('logout',[RegisterController::class,'logout'])->name('logout');




//admin
Route::middleware(['auth','auth.admin'])->group(callback: function () {
    Route::get('admindashboard',[IndexController::class,'AdminDashboard'])->name('admindashboard');

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

    Route::group(['prefix' => 'message'], function () {
        Route::get('/',[MessageController::class,'index'])->name('admin.message');
        Route::get('show/{id}',[MessageController::class,'show'])->name('admin.message.show');
        Route::get('delete/{id}',[MessageController::class,'delete'])->name('admin.message.delete');
        Route::get('add',[MessageController::class,'add'])->name('admin.message.add');

    });
});
//messages

//order
Route::group(['prefix' => 'order'], function () {
    Route::get('/',[OrderController::class,'index'])->name('admin.order');
    Route::get('show/{id}',[OrderController::class,'show'])->name('admin.order.show');
    Route::get('delete/{id}',[OrderController::class,'delete'])->name('admin.order.delete');
    Route::get('downloadInvoice/{id}',[OrderController::class,'downloadInvoice'])->name('admin.order.download');
    //user_order
    Route::get('/userorder',[IndexController::class,'myorder'])->name('user.order');
    Route::get('/showorderdetails/{id}',[IndexController::class,'showorderdetails'])->name('user.order.showDetails');
    Route::get('updatestatus/{id}',[OrderController::class,'updatestatus'])->name('user.ordersatuts.update');

});
//Review
Route::group(['prefix' => 'review'], function () {
    Route::get('/',[ReviewController::class,'index'])->name('admin.review');
    Route::get('show/{id}',[ReviewController::class,'show'])->name('admin.review.show');
    Route::get('delete/{id}',[ReviewController::class,'delete'])->name('admin.review.delete');

    Route::get('/addreview/{id}',[ReviewController::class,'addreview'])->name('user.review');
    Route::post('/storereview',[ReviewController::class,'storereview'])->name('storereview');

});

//front
//index page website


//-------------------------------------

Route::middleware(['auth'])->group(function () {
    //--profile
    Route::get('profile', [profileController::class,'profile'])->name('profile');
    Route::get('/editprofile/{id}',[profileController::class,'editprofile'])->name('editprofile');
    Route::post('/updateprofile/{id}', [profileController::class,'updateprofile'])->name('updateprofile');


    Route::get('/', [\App\Http\Controllers\IndexController::class,'index'])->name('index');
    Route::get('/shop', [\App\Http\Controllers\front\ShopController::class,'shop'])->name('shop');
    Route::get('/about', [\App\Http\Controllers\front\FrontendController::class,'about'])->name('about');
    Route::get('/list', [\App\Http\Controllers\front\ShopController::class,'list'])->name('list');
    Route::get('detail_product/{category_id}',[IndexController::class,'detail_product'])->name('detail_product');



    //--whishlist--------------------------------------
    Route::post('addtowishlist/{id}', [WishlistController::class,'addtowishlist'])->name('addtowishlist');
    Route::get('showwishlist', [WishlistController::class,'showwishlist'])->name('showwishlist');
    Route::get('removewishlist/{id}', [WishlistController::class,'removewishlist'])->name('removewishlist');

    //--cart--------------------------------
    Route::post('addtocart/{id}', [CartController::class,'addtocart'])->name('addtocart');
    Route::get('cart', [CartController::class,'showcart'])->name('showcart');
    Route::get('removecartitem/{id}', [CartController::class,'removefromcart'])->name('removecart');
    Route::post('/update_cart_item', [CartController::class,'updatecart'])->name('updatecart');
    Route::get('load-cart-data', [CartController::class, 'cartCount']);


    //--checkout---------------------------------
    Route::get('/check', [CheckoutController::class,'check'])->name('check');
    Route::post('/checkout', [CheckoutController::class,'checkout'])->name('checkout');
    Route::post('/razorpay', [CheckoutController::class,'razorpay'])->name('razorpay');

    Route::get('/paypalprocess', [CheckoutController::class,'paypalprocess'])->name('paypalprocess');
    Route::get('/cancel', [CheckoutController::class,'cancel'])->name('cancel');
    Route::get('/success', [CheckoutController::class,'success'])->name('success');





});

Route::get('/contact', [\App\Http\Controllers\front\Contact_usController::class,'contact_us'])->name('contact');
Route::post('/send_contact_form', [\App\Http\Controllers\front\Contact_usController::class,'submit_contact_form'])->name('send_contact_form');

Route::get('/privacy-policy', [IndexController::class,'privacy_policy'])->name('privacy-policy');
Route::get('/terms-conditions', [IndexController::class,'terms_conditions'])->name('terms-conditions');
Route::get('/return-policy', [IndexController::class,'return_policy'])->name('return-policy');
Route::get('home',[IndexController::class,'home'])->name('home');

