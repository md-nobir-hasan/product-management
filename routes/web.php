<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DurationController;
use App\Http\Controllers\GraphicController;
use App\Http\Controllers\GtagController;
use App\Http\Controllers\hddController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PixelController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\ProcessorGenerationController;
use App\Http\Controllers\ProcessorModelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOfferController;
use App\Http\Controllers\RamController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\SpecialFeatureController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\UsersController;
use \UniSharp\LaravelFilemanager\Lfm;

//Home routes
Route::get('/', function () {
    return to_route('login');
});
// CACHE CLEAR ROUTE
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');
    request()->session()->flash('success', 'Successfully cache cleared.');
    return redirect()->back();
})->name('cache.clear');

// Storage Link
Route::get('mdnh/str-link', function () {
    Artisan::call('storage:link');
    echo 'Storage linked successfully';
})->name('mdnh.sl');

// STORAGE LINKED ROUTE
Route::get('storage-link', [AdminController::class, 'storageLink'])->name('storage.link');

Auth::routes(['register' => false]);

Route::get('user/login', [FrontendController::class, 'login'])->name('login.form');
Route::post('user/login', [FrontendController::class, 'loginSubmit'])->name('login.submit');
Route::get('user/logout', [FrontendController::class, 'logout'])->name('user.logout');

// Route::get('user/register', [FrontendController::class, 'register'])->name('register.form');
// Route::post('user/register', [FrontendController::class, 'registerSubmit'])->name('register.submit');
// Reset password
Route::post('password-reset', [FrontendController::class, 'showResetForm'])->name('password.reset');

// Socialite
Route::get('login/{provider}', [LoginController::class, 'redirect'])->name('login.redirect');
Route::get('login/{provider}/callback', [LoginController::class, 'Callback'])->name('login.callback');
// Route::get('login/google/callback', [LoginController::class, 'check'])->name('login.callback');


// Frontend Routes
Route::get('/home', [FrontendController::class, 'index']);
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact/message', [MessageController::class, 'store'])->name('contact.store');
Route::get('/product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');
Route::post('/product/search', [FrontendController::class, 'productSearch'])->name('product.search');
Route::get('/product-cat/{slug}', [FrontendController::class, 'productCat'])->name('product-cat');
Route::get('/product-sub-cat/{slug}/{sub_slug}', [FrontendController::class, 'productSubCat'])->name('product-sub-cat');
Route::get('/product-brand/{slug}', [FrontendController::class, 'productBrand'])->name('product-brand');

// Cart section
Route::get('/add-to-cart/{slug}', [CartController::class, 'addToCart'])->name('add-to-cart')->middleware('user');
Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('user');
Route::get('/cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart-delete');
Route::post('/cart-update', [CartController::class, 'cartUpdate'])->name('cart.update');

Route::get('/cart', function () {
    return view('frontend.pages.cart');
})->name('cart');
// Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('user');
// Wishlist
Route::get('/wishlist', function () {
    return view('frontend.pages.wishlist');
})->name('wishlist');
Route::get('/wishlist/{slug}', [WishlistController::class, 'wishlist'])->name('add-to-wishlist')->middleware('user');
Route::get('/wishlist-delete/{id}', [WishlistController::class, 'wishlistDelete'])->name('wishlist-delete');
Route::post('/cart/order', [OrderController::class, 'store'])->name('cart.order');
Route::get('/order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
Route::get('/income', [OrderController::class, 'incomeChart'])->name('product.order.income');
// Route::get('/user/chart',[AdminController::class, 'userPieChart'])->name('user.piechart');
Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
// Order Track
Route::get('/product/track', [OrderController::class, 'orderTrack'])->name('order.track');
Route::post('product/track/order', [OrderController::class, 'productTrackOrder'])->name('product.track.order');
// Blog
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::get('/blog/search', [FrontendController::class, 'blogSearch'])->name('blog.search');
Route::post('/blog/filter', [FrontendController::class, 'blogFilter'])->name('blog.filter');
Route::get('blog-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('blog.category');
Route::get('blog-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('blog.tag');

// NewsLetter
Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

// // Company Review
// Route::resource('/review', CompanyReviewController::class);
// Route::post('product/{slug}/review', [CompanyReviewController::class, 'store'])->name('review.store');
// Route::post('review-status/change', [CompanyReviewController::class, 'reviewStatusChange'])->name('review_status.change');

// // Product Review
// Route::resource('/productreview', ProductReviewController::class);
// Route::get('/productreview', [ProductReviewController::class,'index'])->name('productreview.index');

// Post Comment
Route::post('post/{slug}/comment', [PostCommentController::class, 'store'])->name('post-comment.store');
Route::resource('/comment', PostCommentController::class);
// Coupon
Route::post('/coupon-store', [CouponController::class, 'couponStore'])->name('coupon-store');
// Payment
Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');


// Backend section start
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function () {

    //Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('admin');

    //Fill Manager
    Route::get('/file-manager', function () {
        return view('backend.layouts.file-manager');
    })->name('file-manager');

    // User Management
    Route::prefix('/admin-user')->name('auser.')->group(function () {
        Route::resource('users', UsersController::class);
        Route::resource('role', RoleController::class);
        Route::get('permission', [RoleController::class, 'permission'])->name('permission');
    });

    // User Management
    Route::prefix('/setting')->name('setting.')->group(function () {
        // Site Settings
        Route::get('/site-settings', [AdminController::class, 'siteSettings'])->name('ss');
        Route::post('/site-setting/update', [AdminController::class, 'siteSettingsUpdate'])->name('ss.update');

        // Other Settings
        Route::get('/other-setting', [AdminController::class, 'otherSettings'])->name('os');
        Route::post('/setting/update', [AdminController::class, 'otherSettingsUpdate'])->name('os.update');
    });

    // // SEO Management
    // Route::prefix('/seo')->name('seo.')->group(function () {
    //     Route::resource('gtag', GtagController::class);
    //     Route::resource('pixel', PixelController::class);
    // });

    // Banner
    Route::resource('banner', BannerController::class);
    // Brand
    Route::resource('brand', BrandController::class);

    // Profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
    Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');

    // Category
    Route::resource('/category', CategoryController::class);

    //Product Attribute
    Route::prefix('/product-attributes')->name('pa.')->group(function () {
        Route::resource('/branch', BranchController::class);
        Route::resource('/size', SizeController::class);
        Route::resource('/color', ColorController::class);

        // Route::resource('/processor-model', ProcessorModelController::class);
        // Route::resource('/processor-generation', ProcessorGenerationController::class);
        // Route::resource('/ram', RamController::class);
        // Route::resource('/hdd', hddController::class);
        // Route::resource('/graphic', GraphicController::class);
        // Route::resource('/special-feature', SpecialFeatureController::class);
        // Route::resource('/product-offers', ProductOfferController::class);
    });

    // Product
    Route::resource('/product', ProductController::class)->middleware(['can:Show Product']);


    // Ajax for sub category
    Route::post('/category/{id}/child', [CategoryController::class, 'getChildByParent']);

    // // POST category
    // Route::resource('/post-category', PostCategoryController::class);

    // Duration
    // Route::resource('/duration', DurationController::class);
    // // Post tag
    // Route::resource('/post-tag', PostTagController::class);
    // // Post
    // Route::resource('/post', PostController::class);

    // Message
    Route::resource('/message', MessageController::class);
    Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');

    // Order
    Route::resource('/order', OrderController::class);
    Route::get('/order/cancel/{id}',[OrderController::class,'cancel'])->name('order.cancel');
    Route::get('/order/uncancel/{id}',[OrderController::class, 'uncancel'])->name('order.uncancel');
    //Selling the products
    Route::get('/selling', [OrderController::class, 'create'])->name('selling');
    // Route::get('/selling-confirm', [OrderController::class,'confirm'])->name('selling.confirm');

    // Order status
    Route::resource('/order-status', OrderStatusController::class);

    // Shipping
    Route::resource('/shipping', ShippingController::class);

    // Coupon
    // Route::resource('/coupon', CouponController::class);


    // Notification
    Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
    Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
    // Password Change
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
    Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('change.password');

    //Report
    Route::prefix('/report')->name('report.')->group(function () {
        // Order Report
        Route::prefix('/order')->name('order.')->group(function () {
            Route::get('/daily', [ReportController::class, 'orderReportDaily'])->name('daily');
            Route::get('/weekly', [ReportController::class, 'orderReportWeekly'])->name('weekly');
            Route::get('/monthly', [ReportController::class, 'orderReportMonthly'])->name('monthly');
            Route::get('/yearly', [ReportController::class, 'orderReportYearly'])->name('yearly');
            Route::get('/date-wise', [ReportController::class, 'orderReportDateWiseSearch'])->name('datewise');
            Route::post('/date-wise', [ReportController::class, 'orderReportDateWise'])->name('datewise');
            Route::get('/product-wise', [ReportController::class, 'orderReportProductWise'])->name('productwise');
        });

        // Sale Report
        Route::prefix('/sale')->name('sale.')->group(function () {
            Route::get('/daily', [ReportController::class, 'saleReportDaily'])->name('daily');
            Route::get('/weekly', [ReportController::class, 'saleReportWeekly'])->name('weekly');
            Route::get('/monthly', [ReportController::class, 'saleReportMonthly'])->name('monthly');
            Route::get('/yearly', [ReportController::class, 'saleReportYearly'])->name('yearly');
            Route::get('/date-wise', [ReportController::class, 'saleReportDateWiseSearch'])->name('datewise');
            Route::post('/date-wise', [ReportController::class, 'saleReportDateWise'])->name('datewise');
            Route::get('/overall', [ReportController::class, 'overall'])->name('overall');
        });
    });
});


// User section start
Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('user');
    // Profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');
    Route::post('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
    //  Order
    Route::get('/order', [HomeController::class, 'orderIndex'])->name('user.order.index');
    Route::get('/order/show/{id}', [HomeController::class, 'orderShow'])->name('user.order.show');
    Route::delete('/order/delete/{id}', [HomeController::class, 'userOrderDelete'])->name('user.order.delete');
    // // Product Review
    // Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
    // Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
    // Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
    // Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');

    // // Post comment
    // Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
    // Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
    // Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
    // Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});
