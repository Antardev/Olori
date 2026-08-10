<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Routes du site — LA MAISON
|--------------------------------------------------------------------------
| Partie vitrine, boutique, espace client et back-office.
| Les routes POST sont des démonstrations (session), à brancher sur la
| base de données et KKiaPay en production.
*/

// Vitrine et boutique
Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/boutique', 'index')->name('shop.index');
    Route::get('/produit/{slug}', 'show')->name('shop.show');
});


// Pages
Route::controller(PageController::class)->group(function () {
    Route::get('/mentions-legales', 'legal')->name('legal');
    Route::get('/politique-confidentialite', 'privacy')->name('privacy');
    Route::get('/conditions-generales-vente', 'terms')->name('terms');
});

// Panier et commande
Route::controller(CartController::class)->group(function () {
    Route::get('/panier', 'index')->name('cart.index');
    Route::post('/panier/ajouter/{slug}', 'add')->name('cart.add');
    Route::post('/panier/retirer/{slug}', 'remove')->name('cart.remove');
});

Route::controller(CheckoutController::class)->group(function () {
    Route::get('/commande', 'index')->name('checkout.index');
    Route::post('/commande', 'store')->name('checkout.store');
    Route::get('/commande/confirmation', 'confirmation')->name('checkout.confirmation');
});


// Authentification — les routes login / register / logout / password.* sont
// fournies automatiquement par Laravel Fortify (voir FortifyServiceProvider).

// Back-office — accès réservé aux administrateurs authentifiés
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/articles', 'products')->name('products');
        Route::get('/articles/nouveau', 'productForm')->name('products.create');
        Route::get('/commandes', 'orders')->name('orders');
        Route::get('/promotions', 'promotions')->name('promotions');
        Route::get('/statistiques', 'stats')->name('stats');
    });
    // Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    // Route::get('/articles', [AdminController::class, 'products'])->name('products');
    // Route::get('/articles/nouveau', [AdminController::class, 'productForm'])->name('products.create');
    // Route::get('/commandes', [AdminController::class, 'orders'])->name('orders');
    // Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
    // Route::get('/statistiques', [AdminController::class, 'stats'])->name('stats');
});
