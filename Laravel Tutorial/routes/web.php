<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');   

Route::get('/bootload', function () {return view('bootload'); });
Route::get('/registration', [RegisterController::class, 'registration'])->name('registration');//register page  
Route::post('/store', [RegisterController::class, 'store'])->name('store');// save data
Route::get('/verifyotp/{number}', [RegisterController::class,'otpverification'])->name('verifyotp');
Route::get('/registeruser', [RegisterController::class,'register'])->name('registeruser');
Route::get('/showusers',[RegisterController::class,'showall'])->name('showdata')->middleware(['check', 'prevent-back-history']);//show user data
Route::get('/loginuser',[RegisterController::class,'login'])->name('userlogin');//login and check login routes
Route::post('/postlogin',[RegisterController::class, 'postlogin'])->name('checklogin');

//update
Route::get('/editdata/{id}',[RegisterController::class,'edit'])->name('edit')->middleware('check');
Route::post('/updatedata/{id}',[RegisterController::class,'update'])->name('update')->middleware('check');

//delete
Route::get('/delete/{id}',[RegisterController::class,'delete'])->name('deletedata')->middleware('check');

//logout
Route::get('/logout',[RegisterController::class,'logout'])->name('logout')->middleware('check');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



//socialite routes
Route::get('/google', [SocialiteController::class, 'signInwithGoogle'])->name('signgoogle');
Route::get('/callback', [SocialiteController::class, 'callbackfromgoogle']);



//blog route
Route::get('/blog', function () {
    return view('blog');
});

Route::post('/blogdata', [BlogController::class, 'storeblogdata'])->name('blogdata');

//razorpay routes
Route::get('/razorpaygate', [RazorpayController::class,'paymentreq'])->name('paygate');
Route::post('/handlepayment', [RazorpayController::class,'paymentres'])->name('payment');

//eloquent
Route::post('/submitdata', [RegisterController::class, 'studentcourse'])->name('submitdata');
Route::post('/updatecourse', [RegisterController::class,'courseupdate'])->name('updatedata');
route::get('/eloquent', function(){
    return view('eloquentdb');
});
Route::post('/deletecoursedata', [RegisterController::class,'coursedelete'])->name('deletecoursedata');
Route::post('/joindata', [RegisterController::class,'joindata'])->name('joindata');




Route::post('/savetoken', [RegisterController::class,'uploadtoken'])->name('saveToken');
Route::post('/pushnotification', [RegisterController::class,'sendnotification'])->name('pushnotification');
require __DIR__.'/auth.php';

