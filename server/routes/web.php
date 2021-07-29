<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\AllUserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

    // Admin All Routes
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');
    // Admin Brand All Routes
    Route::prefix('brand')->group(function () {
        Route::get('/view', [BrandController::class, 'brandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'brandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
    });
    // Admin Category All Routes
    Route::prefix('category')->group(function () {
        Route::get('/view', [CategoryController::class, 'categoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'categoryStore'])->name('categoy.store');
        Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');

        // Admin SubCategory All Routes
        Route::get('/sub/view', [SubCategoryController::class, 'subCategoryView'])->name('all.subCategory');
        Route::post('/sub/store', [SubCategoryController::class, 'subCategoryStore'])->name('subCategoy.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('subCategory.edit');
        Route::post('/sub/update/{id}', [SubCategoryController::class, 'subCategoryUpdate'])->name('subCategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'subCategoryDelete'])->name('subCategory.delete');

        // Admin SubsubCategory All Routes
        Route::get('/sub/sub/view', [SubCategoryController::class, 'subSubCategoryView'])->name('all.subSubCategory');
        Route::get('/subCategory/ajax/{category_id}', [SubCategoryController::class, 'getSubCategory']);
        Route::get('/sub-subCategory/ajax/{subCategory_id}', [SubCategoryController::class, 'getSubSubCategory']);
        Route::post('/sub/sub/store', [SubCategoryController::class, 'subSubCategoryStore'])->name('subSubCategoy.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'subSubCategoryEdit'])->name('subSubCategory.edit');
        Route::post('/sub/sub/update/{id}', [SubCategoryController::class, 'subSubCategoryUpdate'])->name('subSubCategory.update');
        Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'subSubCategoryDelete'])->name('subSubCategory.delete');
    });
    // Admin Products All Routes
    Route::prefix('product')->group(function () {
        Route::get('/add', [ProductController::class, 'addProduct'])->name('add-product');
        Route::post('/store', [ProductController::class, 'storeProduct'])->name('product-store');
        Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage-product');
        Route::get('/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        Route::post('/data/update', [ProductController::class, 'productDataUpdate'])->name('product-update');
        Route::post('/image/update', [ProductController::class, 'multiImageUpdate'])->name('update-product-image');
        Route::post('/thambnail/update/{id}', [ProductController::class, 'thambnailImageUpdate'])->name('update-product-thambnail');
        Route::get('/multiImg/delete/{id}', [ProductController::class, 'multiImageDelete'])->name('product.multiImg.delete');
        Route::get('/inactive/{id}', [ProductController::class, 'productInactive'])->name('product.inactive');
        Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');
        Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
    });

    // Admin Slider All Routes
    Route::prefix('slider')->group(function () {
        Route::get('/view', [SliderController::class, 'sliderView'])->name('manage-slider');
        Route::post('/store', [SliderController::class, 'sliderStore'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
        Route::post('/update/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');
        Route::get('/inactive/{id}', [SliderController::class, 'sliderInactive'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');
    });

    // Admin Coupon All Routes
    Route::prefix('coupons')->group(function () {
        Route::get('/view', [CouponController::class, 'couponView'])->name('manage-coupon');
        Route::post('/store', [CouponController::class, 'couponStore'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'couponEdit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'couponUpdate'])->name('coupon.update');
        Route::get('/delete/{id}', [CouponController::class, 'couponDelete'])->name('coupon.delete');
    });

    // Admin Shipping All Routes
    Route::prefix('shipping')->group(function () {
        // Ship Division
        Route::get('/division/view', [ShippingAreaController::class, 'divisionView'])->name('manage-division');
        Route::post('/division/store', [ShippingAreaController::class, 'divisionStore'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingAreaController::class, 'divisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingAreaController::class, 'divisionUpdate'])->name('division.update');
        Route::get('/division/delete/{id}', [ShippingAreaController::class, 'divisionDelete'])->name('division.delete');

        // Ship Destrict
        Route::get('/district/view', [ShippingAreaController::class, 'districtView'])->name('manage-district');
        Route::post('/district/store', [ShippingAreaController::class, 'districtStore'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'districtEdit'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingAreaController::class, 'districtUpdate'])->name('district.update');
        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'districtDelete'])->name('district.delete');

        // Ship Town
        Route::get('/town/view', [ShippingAreaController::class, 'townView'])->name('manage-town');
        Route::post('/town/store', [ShippingAreaController::class, 'townStore'])->name('town.store');
        Route::get('/town/edit/{id}', [ShippingAreaController::class, 'townEdit'])->name('town.edit');
        Route::post('/town/update/{id}', [ShippingAreaController::class, 'townUpdate'])->name('town.update');
        Route::get('/town/delete/{id}', [ShippingAreaController::class, 'townDelete'])->name('town.delete');
    });
});

// User All Routes
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'userChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'userPasswordUpdate'])->name('user.password.update');

// Frontend All Routes
// Multi Language All Routes
Route::get('/language/english', [LanguageController::class, 'english'])->name('english.language');
Route::get('/language/japanese', [LanguageController::class, 'japanese'])->name('japanese.language');

// Frontend Product Details Page url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'productDetails']);

// Frontend Product Tags Page
Route::get('/product/tag/{tag}', [IndexController::class, 'tagWiseProduct']);

// Frontend SubCategory Wise Data
Route::get('/subCategory/product/{subCat_id}/{slug}', [IndexController::class, 'subCatWiseProduct']);

// Frontend SubSubCategory Wise Data
Route::get('/subSubCategory/product/{subSubCat_id}/{slug}', [IndexController::class, 'subSubCatWiseProduct']);

// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjax']);

// Add to Cart Store Data
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);

// Get Data from mini cart
Route::get('/product/mini/cart', [CartController::class, 'addMiniCart']);

// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'removeMiniCart']);

// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'addToWishlist']);

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function () {
    // Wishlist Page
    Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist');

    Route::get('/get-wishlist-product', [WishlistController::class, 'getWishlistProduct']);

    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'removeWishlistProduct']);

    Route::post('/strip/order', [StripController::class, 'stripeOrder'])->name('stripe.order');

    Route::post('/cash/order', [CashController::class, 'cashOrder'])->name('cash.order');

    Route::get('/my/orders', [AllUserController::class, 'myOrders'])->name('my.orders');

    Route::get('/order_details/{order_id}', [AllUserController::class, 'orderDetails']);

    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'invoiceDownload']);
});

// My Cart Page All Routes
Route::get('/mycart', [CartPageController::class, 'myCart'])->name('mycart');

Route::get('/user/get-cart-product', [CartPageController::class, 'getCartProduct']);

Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'removeCartProduct']);

Route::get('/cart-increment/{rowId}', [CartPageController::class, 'cartIncrement']);

Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'cartDecrement']);

// Frontend Coupon Option
Route::post('/coupon-apply', [CartController::class, 'couponApply']);
Route::get('/coupon-calculation', [CartController::class, 'couponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'couponRemove']);

// Checkout Routes
Route::get('/checkout', [CartController::class, 'checkoutCreate'])->name('checkout');
Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'districtGetAjax']);
Route::get('/town-get/ajax/{district_id}', [CheckoutController::class, 'townGetAjax']);
Route::post('/checkout/store', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');
