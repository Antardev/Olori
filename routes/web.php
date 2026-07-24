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
Route::get('/', [ShopController::class, 'home'])->name('home');
Route::get('/boutique', [ShopController::class, 'index'])->name('shop.index');
Route::get('/produit/{slug}', [ShopController::class, 'show'])->name('shop.show');

// Pages
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'send'])->name('contact.send');
Route::get('/vue-360', [PageController::class, 'view360'])->name('view360');

// Panier et commande
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter/{slug}', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/retirer/{slug}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/commande', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/commande', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/commande/confirmation', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

// Authentification — les routes login / register / logout / password.* sont
// fournies automatiquement par Laravel Fortify (voir FortifyServiceProvider).

// Back-office — accès réservé aux administrateurs authentifiés
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/articles', [AdminController::class, 'products'])->name('products');
    Route::get('/articles/nouveau', [AdminController::class, 'productForm'])->name('products.create');
    Route::get('/commandes', [AdminController::class, 'orders'])->name('orders');
    Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
    Route::get('/statistiques', [AdminController::class, 'stats'])->name('stats');
});
