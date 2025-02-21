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

Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/cart', CartPage::class);
Route::get('/checkout', CheckoutPage::class);
Route::get('/products/{product}', ProductDetailPage::class);

Route::get('/my-orders', MyOrderPage::class);
Route::get('/my-orders/{order}', MyOrderDetailPage::class);

Route::get('/login', Login::class);
Route::get('/register', Register::class);
Route::get('/forgot', Forgot::class);
Route::get('/reset', ResetPassword::class);
Route::get('/success', SuccessPage::class);
Route::get('/cancel', CancelPage::class);
