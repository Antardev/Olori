<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Support\DemoData;

/*
|--------------------------------------------------------------------------
| Routes du site — LA MAISON
|--------------------------------------------------------------------------
| Partie vitrine, catégories, espace client et back-office.
| Les routes POST sont des démonstrations (session), à brancher sur la
| base de données et KKiaPay en production.
*/

// Vitrine et fiches produit
Route::controller(ShopController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/produit/{slug}', 'show')->name('shop.show');
});


// Pages
Route::controller(PageController::class)->group(function () {
    Route::get('/a-propos', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'send')->name('contact.send');
    Route::get('/vue-360', 'view360')->name('view360');
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
        Route::post('/articles', 'storeProduct')->name('products.store');
        Route::delete('/articles/{product}', 'destroyProduct')->name('products.destroy');
        Route::get('/commandes', 'orders')->name('orders');
        Route::get('/promotions', 'promotions')->name('promotions');
        Route::get('/statistiques', 'stats')->name('stats');
    });
});

// Une page dédiée par catégorie : /hommes, /femmes…
// Déclarée en dernier : la contrainte limite l'URL aux slugs connus,
// les autres routes du site restent donc prioritaires.
Route::get('/{categorie}', [ShopController::class, 'category'])
    ->whereIn('categorie', array_keys(DemoData::categories()))
    ->name('shop.category');
