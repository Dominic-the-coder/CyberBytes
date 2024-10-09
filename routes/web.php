<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\ReviewController;

// Home page
Route::get('/', [ HomeController::class, 'loadHomePage' ]);

// Error page
Route::fallback([ErrorController::class, 'show404']);

// Product page
// Route::get("/products", [ ProductsController::class, 'loadProductsPage' ]);

// About page
Route::get("/about", [ AboutController::class, 'loadAboutPage' ]);

// Contact page
Route::get("/contact", [ ContactController::class, 'loadContactPage' ]);

// Cart page
Route::get("/cart", [ CartController::class, 'loadCartPage' ])->name('cart.view');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/cart/edit/{id}', [CartController::class, 'editQuantity'])->name('cart.edit');

// Edit page
Route::put('/products/edit', [ProductController::class, 'updateProduct'])->name('product.edit');

// Delete page
Route::delete('/products/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
Route::post('/products/add',[ProductController::class, 'addProduct'])->name('product.add');

// Review page
Route::post('/reviews/add', [ReviewController::class, 'addReview'])->name('review.add');
Route::delete('/reviews/delete/{id}', [ReviewController::class, 'deleteReview'])->name('review.delete');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');


// Login page
Route::get("/login", [
    LoginController::class,
    'loadLoginPage'
]);

// Login logic
Route::post("/login", [
    LoginController::class,
    'doLogin'
]);

// Sign up page
Route::get("/signup", [
    SignUpController::class,
    'loadSignUpPage'
]);
// Sign up logic
Route::post("/signup", [
    SignUpController::class,
    'doSignUp'
]);

// Logout
Route::get("/logout", [
    LogoutController::class,
    'logout'
]);

// Route to product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Post routes
/*
- GET `/posts` (index)
- GET `/posts/create` (create)
- POST `/posts` (store)
- GET `/posts/{post}` (show)
- GET `/posts/{post}/edit` (edit)
- PUT/PATCH `/posts/{post}` (update)
- DELETE `/posts/{post}` (destroy)
*/
Route::resource("posts", PostController::class);