<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\BotManController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('userpassword/update', [ChangePasswordController::class, 'update'])->name('user.changePassword');
});

Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth','verified');
Route::get('/view_category',[AdminController::class,'view_category']);
Route::post('/add_category',[AdminController::class,'add_category']);
Route::get('/delete_category/{id}',[AdminController::class,'delete_category']);
Route::get('/view_product',[AdminController::class,'view_product']);
Route::post('/add_product',[AdminController::class,'add_product']);
Route::get('/show_product',[AdminController::class,'show_product']);
Route::get('/delete_product/{id}',[AdminController::class,'delete_product']);
Route::get('/update_product/{id}',[AdminController::class,'update_product']);
Route::post('/update_product_confirm/{id}',[AdminController::class,'update_product_confirm']);
Route::get('/order',[AdminController::class,'order']);
Route::get('/delivered/{id}',[AdminController::class,'delivered']);
Route::get('/print_pdf/{id}',[AdminController::class,'print_pdf']);
Route::get('/send_email/{id}',[AdminController::class,'send_email']);
Route::get('/profile',[AdminController::class,'profile']);
Route::post('/updprofile',[AdminController::class,'updateprofile']);
Route::get('/change-password',[AdminController::class,'passwordcreate']);
Route::post('/updpassword',[AdminController::class,'updatepassword']);
// Route::post('/send_user_email/{id}',[AdminController::class,'send_user_email']);
Route::get('/product_details/{id}',[HomeController::class,'product_details']);
Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
Route::get('/show_cart',[HomeController::class,'show_cart']);
Route::get('/remove_product/{id}',[HomeController::class,'remove_product']);
Route::get('/cash_order',[HomeController::class,'cash_order']);
Route::get('/stripe/{totalprice}',[HomeController::class,'stripe']);
Route::post('stripe/{totalprice}',[HomeController::class,'stripePost'])->name('stripe.post');
Route::get('razorpay/{totalprice}', [HomeController::class, 'razorpay'])->name('razorpay');
Route::post('razorpaypayment/{totalprice}', [HomeController::class, 'payment'])->name('payment');
Route::get('/show_order',[HomeController::class,'show_order']);
Route::get('/cancel_order/{id}',[HomeController::class,'cancel_order']);
Route::post('/add_comment',[HomeController::class,'add_comment']);
Route::get('/view-category/{category_name}',[HomeController::class,'view_category']);
Route::post('/add_reply',[HomeController::class,'add_reply']);
Route::get('/category_search',[HomeController::class,'category_search']);
Route::get('/products',[HomeController::class,'all_products']);
Route::get('/success/{id}',[HomeController::class,'success'])->name('success');
Route::get('/generate-invoice/{id}',[HomeController::class,'invoice']);
Route::get('auth/google',[GoogleController::class,'googlepage']);
Route::get('auth/google/callback',[GoogleController::class,'googlecallback']);






















