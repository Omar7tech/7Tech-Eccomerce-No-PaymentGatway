<?php

use App\Livewire\About;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Categories;
use App\Livewire\Category;
use App\Livewire\Home;
use App\Livewire\NewArrival;
use App\Livewire\Product;
use App\Livewire\Products;
use App\Livewire\Sale;
use App\Livewire\Checkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/new-arrival', NewArrival::class)->name('new-arrival');
Route::get('/sale', Sale::class)->name('sale');
Route::get('/about', About::class)->name('about');
Route::get('/categories', Categories::class)->name('categories');
Route::get('/category/{category}', Category::class)->name('category');
Route::get('/products', Products::class)->name('products');
Route::get('/product/{product}', Product::class)->name('product.show');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/checkout');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', App\Livewire\UserProfile::class)->name('profile');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('auth.logout');
