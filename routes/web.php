<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('product','Admin\ProductController@index')->name('product.index');
Route::get('product/{category}/create','Admin\ProductController@create')->name('product.create');

Route::get('post','FreePostController@index')->name('post.index');
Route::get('post/{post_id}/create','FreePostController@create')->name('post.create');

// Route::resource('admin/seo', 'AdminSeoController');
//
// // Routes for the menu admin
Route::group(array('prefix' => 'admin/menu'), function()
{
    // Showing the admin for the menu builder and updating the order of menu items
    Route::get('/', 'Admin\MenuController@getIndex');
    Route::post('/', 'Admin\MenuController@postIndex');

    Route::post('new', 'Admin\MenuController@postNew');
    Route::post('delete', 'Admin\MenuController@postDelete');

    Route::get('edit/{id}', 'Admin\MenuController@getEdit');
    Route::post('edit/{id}', 'Admin\MenuController@postEdit');
});
//
// // This is the route for the Backbone pagination
// Route::get('api/products', 'ApiProductsController@getIndex');
//
// // Route for Homepage - displays all products from the shop
// Route::get('/', function()
// {
// 	$products = Product::all();
// 	$categories = Category::all();
//
// 	return View::make('index', array(
// 		'products'		=> $products,
// 		'categories' 	=> $categories
// 	));
// });
//
// // Route that shows an individual product by its slug
// Route::get('products/{slug}', function($slug)
// {
// 	$product 	= Product::whereSlug($slug)->firstOrFail();
// 	$categories = Category::all();
// 	$seo 		= $product->seo()->first();
//
// 	// Get all reviews that are not spam for the product and paginate them
// 	$reviews = $product->reviews()->with('user')->approved()->notSpam()->orderBy('created_at','desc')->paginate(100);
//
// 	return View::make('products.single', array(
// 		'product'	=> $product,
// 		'reviews'	=> $reviews,
// 		'categories'=> $categories,
// 		'seo'		=> $seo
// 	));
// });
//
// // Route that handles submission of review - rating/comment
// Route::post('products/{slug}', array('before'=>'csrf', function($slug)
// {
// 	$input = array(
// 		'comment' => Input::get('comment'),
// 		'rating'  => Input::get('rating')
// 	);
// 	// instantiate Rating model
// 	$review = new Review;
//
// 	// Validate that the user's input corresponds to the rules specified in the review model
// 	$validator = Validator::make( $input, $review->getCreateRules());
//
// 	// If input passes validation - store the review in DB, otherwise return to product page with error message
// 	if ($validator->passes()) {
// 		$review->storeReviewForProduct($slug, $input['comment'], $input['rating']);
// 		return Redirect::to('products/'.$slug.'#reviews-anchor')->with('review_posted',true);
// 	}
//
// 	return Redirect::to('products/'.$slug.'#reviews-anchor')->withErrors($validator)->withInput();
// }));
//
// // Route that shows an individual category by its slug
// Route::get('categories/{slug}', function($slug)
// {
// 	$category = Category::whereSlug($slug)->firstOrFail();
// 	$categories = Category::all();
// 	$seo 		= $category->seo()->first();
//
// 	return View::make('categories.single', array(
// 		'category'	=> $category,
// 		'categories'=> $categories,
// 		'seo'		=> $seo
// 	));
// });
//
// Route::get('api/search', 'ApiSearchController@index');