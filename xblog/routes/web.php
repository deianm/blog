<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
// User Auth
Auth::routes();
Route::get('/auth/github', ['uses' => 'Auth\AuthController@redirectToGithub', 'as' => 'github.login']);
Route::get('/auth/github/callback', ['uses' => 'Auth\AuthController@handleGithubCallback', 'as' => 'github.callback']);
Route::get('/github/register', ['uses' => 'Auth\AuthController@registerFromGithub', 'as' => 'github.register']);
Route::post('/github/store', ['uses' => 'Auth\AuthController@store', 'as' => 'github.store']);

// Site route
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'index']);
Route::get('/projects', ['uses' => 'HomeController@projects', 'as' => 'projects']);
Route::get('/search', ['uses' => 'HomeController@search', 'as' => 'search']);
Route::get('/achieve', ['uses' => 'HomeController@achieve', 'as' => 'achieve']);

// Post
Route::get('/blog', ['uses' => 'PostController@index', 'as' => 'post.index']);
Route::get('/blog/{slug}', ['uses' => 'PostController@show', 'as' => 'post.show']);

// Category
Route::get('/category/{name}', ['uses' => 'CategoryController@show', 'as' => 'category.show']);
Route::get('/category', ['uses' => 'CategoryController@index', 'as' => 'category.index']);

// Tag
Route::get('/tag/{name}', ['uses' => 'TagController@show', 'as' => 'tag.show']);
Route::get('/tag', ['uses' => 'TagController@index', 'as' => 'tag.index']);

// User
Route::get('/user/{name}', ['uses' => 'UserController@show', 'as' => 'user.show']);
Route::get('/notifications', ['uses' => 'UserController@notifications', 'as' => 'user.notifications']);
Route::patch('/user/upload/avatar', ['uses' => 'UserController@uploadAvatar', 'as' => 'user.upload.avatar']);
Route::patch('/user/upload/profile', ['uses' => 'UserController@uploadProfile', 'as' => 'user.upload.profile']);
Route::patch('/user/upload/info', ['uses' => 'UserController@update', 'as' => 'user.update.info']);

// Comment
Route::get('/commentable/{commentable_id}/comments', ['uses' => 'CommentController@show', 'as' => 'comment.show']);
Route::resource('comment', 'CommentController', ['only' => ['store', 'destroy', 'edit', 'update']]);

// Examples Index
Route::get('/examples/datatables', ['uses' => 'ExampleController@index']);

// Datatables examples //

//View
Route::post('/examples/datatables/basic-ssp', ['uses' => 'Examples\DatatablesBasicSSPController@index', 'as' => 'basic-ssp']);
Route::get('/examples/datatables/basic-ssp', ['uses' => 'Examples\DatatablesBasicSSPController@index', 'as' => 'basic-ssp']);

//Basic
Route::post('/examples/datatables/basic-ssp-data', ['uses' => 'Examples\DatatablesBasicSSPController@allusers', 'as' => 'basic-ssp-data']);
Route::get('/examples/datatables/basic-ssp-data', ['uses' => 'Examples\DatatablesBasicSSPController@allusers', 'as' => 'basic-ssp-data']);


// Coupon Routes //
Route::post('/examples/coupon-system', ['uses' => 'Examples\CouponSystemController@index', 'as' => 'coupon-system']);
Route::get('/examples/coupon-system', ['uses' => 'Examples\CouponSystemController@index', 'as' => 'coupon-system']);

//Coupon Generator Routes
Route::get( '/examples/coupon-system/get_all_coupons', 'Examples\CouponSystemController@getAllCoupons' );
Route::post( '/examples/coupon-system/get_all_coupons', 'Examples\CouponSystemController@getAllCoupons' );

Route::get( '/examples/coupon-system/generate_ajax_coupon', 'Examples\CouponSystemController@generateCoupon' );
Route::post( '/examples/coupon-system/generate_ajax_coupon', 'Examples\CouponSystemController@generateCoupon' );

Route::get( '/examples/coupon-system/confirmed_ajax_coupon', 'Examples\CouponSystemController@submitCoupon' );
Route::post( '/examples/coupon-system/confirmed_ajax_coupon', 'Examples\CouponSystemController@submitCoupon' );

Route::post( '/examples/coupon-system/get_advertiser_list', 'Examples\CouponSystemController@getAdvertiserList' );
Route::get( '/examples/coupon-system/get_advertiser_list', 'Examples\CouponSystemController@getAdvertiserList' );

Route::post( '/examples/coupon-system/pause_coupon', 'Examples\CouponSystemController@pauseCoupon' );
Route::get( '/examples/coupon-system/pause_coupon', 'Examples\CouponSystemController@pauseCoupon' );

Route::post( '/examples/coupon-system/coupon_usage', 'Examples\CouponSystemController@couponUsage' );
Route::get( '/examples/coupon-system/coupon_usage', 'Examples\CouponSystemController@couponUsage' );

Route::post( '/examples/coupon-system/reverse_coupon', 'Examples\CouponSystemController@resumeCoupon' );
Route::get( '/examples/coupon-system/reverse_coupon', 'Examples\CouponSystemController@resumeCoupon' );

Route::post( '/examples/coupon-system/delete_coupon', 'Examples\CouponSystemController@deleteCoupon' );
Route::get( '/examples/coupon-system/delete_coupon', 'Examples\CouponSystemController@deleteCoupon' );

// Resume
Route::get('/resume', ['uses' => 'ResumeController@index']);


//EDMUNDS

Route::get( '/edmunds-testing/', 'Edmunds\Homepage\HomeController@index');

Route::post( '/edmunds-testing/endpoint-build', 'Edmunds\GRequest\RequestBuildController@endpoint_build');
Route::get( '/edmunds-testing/endpoint-build', 'Edmunds\GRequest\RequestBuildController@endpoint_build');

Route::post( '/edmunds/fetch-endpoints', 'Edmunds\GRequest\RequestBuildController@fetch_endpoints');
Route::get( '/edmunds/fetch-endpoints', 'Edmunds\GRequest\RequestBuildController@fetch_endpoints');

Route::post( '/edmunds/build-payload', 'Edmunds\GRequest\RequestBuildController@build_payload');
Route::get( '/edmunds/build-payload', 'Edmunds\GRequest\RequestBuildController@build_payload');

Route::get( '/edmunds/get-all-vehicles', 'Edmunds\VehicleAPI\VehicleMakeController@get_all_car_makes');
Route::get( '/edmunds/get-car-make-details-by-make-nicename','Edmunds\VehicleAPI\VehicleMakeController@get_car_make_details_by_make_nicename');
Route::get( '/edmunds/get-car-make-count','Edmunds\VehicleAPI\VehicleMakeController@get_car_makes_count');


// SiteMap
Route::get('sitemap', 'SiteMapController@index');
Route::get('sitemap.xml', 'SiteMapController@index');

Route::get('/jwt', ['uses' => 'JwtController@index']);
Route::get('/jwt-get', ['uses' => 'JwtController@index']);


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    /**
     * admin url
     */
    Route::get('/', ['uses' => 'AdminController@index', 'as' => 'admin.index']);
    Route::get('/settings', ['uses' => 'AdminController@settings', 'as' => 'admin.settings']);
    Route::post('/settings', ['uses' => 'AdminController@saveSettings', 'as' => 'admin.save-settings']);
    Route::post('/upload/image', ['uses' => 'ImageController@uploadImage', 'as' => 'upload.image']);
    Route::delete('/delete/file', ['uses' => 'FileController@deleteFile', 'as' => 'delete.file']);
    Route::post('/upload/file', ['uses' => 'FileController@uploadFile', 'as' => 'upload.file']);


    /**
     * admin uri
     */
    Route::get('/posts', ['uses' => 'AdminController@posts', 'as' => 'admin.posts']);
    Route::get('/comments', ['uses' => 'AdminController@comments', 'as' => 'admin.comments']);
    Route::get('/tags', ['uses' => 'AdminController@tags', 'as' => 'admin.tags']);
    Route::get('/users', ['uses' => 'AdminController@users', 'as' => 'admin.users']);
    Route::get('/pages', ['uses' => 'AdminController@pages', 'as' => 'admin.pages']);
    Route::get('/categories', ['uses' => 'AdminController@categories', 'as' => 'admin.categories']);
    Route::get('/images', ['uses' => 'ImageController@images', 'as' => 'admin.images']);
    Route::get('/files', ['uses' => 'FileController@files', 'as' => 'admin.files']);

    /**
     * comment
     */
    Route::post('/comment/{comment}/restore', ['uses' => 'CommentController@restore', 'as' => 'comment.restore']);

    /**
     * post
     */

    Route::post('/post/{post}/restore', ['uses' => 'PostController@restore', 'as' => 'post.restore']);
    Route::get('/post/{slug}/preview', ['uses' => 'PostController@preview', 'as' => 'post.preview']);
    Route::post('/post/{post}/publish', ['uses' => 'PostController@publish', 'as' => 'post.publish']);

    /**
     * tag
     */
    Route::delete('/tag/{tag}', ['uses' => 'TagController@destroy', 'as' => 'tag.destroy']);
    Route::post('/tag', ['uses' => 'TagController@store', 'as' => 'tag.store']);

    /**
     * admin resource
     */
    Route::resource('post', 'PostController', ['except' => ['show', 'index']]);
    Route::resource('category', 'CategoryController', ['except' => ['index', 'show', 'create']]);
    Route::resource('page', 'PageController', ['except' => ['show', 'index']]);

});

/*
 * must last
 */
Route::get('/{name}', ['uses' => 'PageController@show', 'as' => 'page.show']);