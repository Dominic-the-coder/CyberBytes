<?php

use Illuminate\Support\Facades\Route;

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

// home page
Route::get('/', [ HomeController::class, 'loadHomePage' ]);

//product page
Route::get("/products", [ ProductsController::class, 'loadProductsPage' ]);

//about page
Route::get("/about", [ AboutController::class, 'loadAboutPage' ]);

//contact page
Route::get("/contact", [ ContactController::class, 'loadContactPage' ]);

//cart page
Route::get("/cart", [ CartController::class, 'loadCartPage' ]);

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