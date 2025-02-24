<?php

use App\Livewire\Auth\Forgot;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrderPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\password;

Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/products/{slug}', ProductDetailPage::class);


Route::middleware('guest')->group(function(){
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class);
    Route::get('/forgot', Forgot::class)->name('password.request');
    Route::get('/reset/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function(){
    Route::get('/logout', function(){
        auth()->logout();
        return redirect('/');
    });
    Route::get('/checkout', CheckoutPage::class);
    Route::get('/success', SuccessPage::class);
    Route::get('/cancel', CancelPage::class);
    Route::get('/my-orders', MyOrderPage::class);
    Route::get('/my-orders/{order}', MyOrderDetailPage::class);
});
