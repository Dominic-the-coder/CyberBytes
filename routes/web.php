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

// Home page
Route::get('/', [ HomeController::class, 'loadHomePage' ]);

//Product page
// Route::get("/products", [ ProductsController::class, 'loadProductsPage' ]);

//About page
Route::get("/about", [ AboutController::class, 'loadAboutPage' ]);

//Contact page
Route::get("/contact", [ ContactController::class, 'loadContactPage' ]);

//Cart page
Route::get("/cart", [ CartController::class, 'loadCartPage' ])->name('cart.view');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/cart/edit/{id}', [CartController::class, 'editQuantity'])->name('cart.edit');

//Edit page
Route::put('/products/edit', [ProductController::class, 'updateProduct'])->name('product.edit');

//Delete page
Route::delete('/products/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');

// login page
Route::get("/login", [
    LoginController::class,
    'loadLoginPage'
]);

// login logic
Route::post("/login", [
    LoginController::class,
    'doLogin'
]);

// sign up page
Route::get("/signup", [
    SignUpController::class,
    'loadSignUpPage'
]);
// Sign up logic
Route::post("/signup", [
    SignUpController::class,
    'doSignUp'
]);

// logout
Route::get("/logout", [
    LogoutController::class,
    'logout'
]);

Route::view('upload','upload');
route::post('upload', [UploadController::class, 'upload']);


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