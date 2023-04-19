<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\Adm\RoleController;
use App\Http\Controllers\LanguageController;
use App\Models\Shop;
use App\Models\Cart;


Route::get('/',function(){
   return redirect()->route('shops.index');
});

Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('switch.lang');

Route::middleware('auth')->group(function (){
    Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
    Route::resource('shops', ShopController::class)->except('index','show');
    Route::resource('/comments', CommentController::class)->only('store','destroy');

    Route::post('/shops/{shop}/cart', [ShopController::class,'cart'])->name('shops.cart');
    Route::get('/shops/{shop}/undelete', [ShopController::class, 'undelete'])->name('shops.undelete');
    Route::get('/shops/cart', [ShopController::class, 'carts'])->name('shops.carts');
    Route::post('/cart/{user}', [ShopController::class, 'buy'])->name('shops.buy');
    Route::get('/shop/user/kabinet',[ShopController::class, 'office'])->name('shop.user');
    Route::get('/shot', [UserController::class, 'shot'])->name('shops.shoot');
    Route::post('shops/{user}/addMoney', [UserController::class, 'addMoney'])->name('shops.addMoney');
});

    Route::prefix('adm')->as('adm.')->middleware('hasrole:admin,moderator')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index'); //user
        route::get('/users/search', [UserController::class, 'index'])->name('users.search');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::put('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::put('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
        Route::get('/categories', [UserController::class, 'show'])->name('categories.show');  //category
        Route::get('/users/comments', [UserController::class, 'comments'])->name('users.comments');
        Route::get('/categories/create',[ UserController::class, 'create'])->name('categories.create');
        Route::post('/categories', [UserController::class, 'store'])->name('categories.store');
        Route::get('/cart', [UserController::class, 'cart'])->name('shops.cart'); //user cart
        Route::put('/cart/{cart}/confirm', [UserController::class, 'confirm'])->name('cart.confirm'); //admin cart
    });


Route::get('/shops/category/{category}', [ShopController::class, 'shopsByCategory'])->name('shops.category');

Route::resource('shops',ShopController::class)->only('index','show');
Route::resource('comments', CommentController::class)->except('store', 'destroy');

Route::get('/edit/profile/{user}',[RegisterController::class,'updateregister'])->name('shops.updateregister');
Route::put('update/profile/{user}',[RegisterController::class,'editprofile'])->name('shops.editprofile');

//Auth::routes()

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'create'])->name('register.form');
Route::post('/register',[RegisterController::class, 'register'])->name('register');

Route::get('/login', [LoginController::class, 'create'])->name('login.form');
Route::post('/login',[LoginController::class, 'login'])->name('login');






//Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
//Route::get('/shops/create', [ShopController::class, 'create'])->name('shops.create');
//Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
//Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');
//Route::delete('/shops/delete/', [ShopController::class, 'destroy'])->name('shops.delete');
//Route::get('/shops/edit/', [ShopController::class, 'edit'])->name('shops.edit');
//Route::put('/shops/edit/success/', [ShopController::class, 'update'])->name('shops.update');
