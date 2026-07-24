<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\DemoData;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = DemoData::products();

        return view('admin.dashboard', [
            'orders'    => DemoData::orders(),
            'statuses'  => DemoData::statuses(),
            'lowStock'  => array_filter($products, fn ($p) => $p['stock'] <= 2),
            'kpis'      => ['ventes' => 1240000, 'commandes' => 47, 'visites' => 3210, 'panier_moyen' => 26400],
        ]);
    }

    public function products()
    {
        return view('admin.products', ['products' => DemoData::products(), 'categories' => DemoData::categories()]);
    }

    public function productForm()
    {
        return view('admin.product-form', ['categories' => DemoData::categories()]);
    }

    public function orders()
    {
        return view('admin.orders', ['orders' => DemoData::orders(), 'statuses' => DemoData::statuses()]);
    }

    public function promotions()
    {
        return view('admin.promotions');
    }

    public function stats()
    {
        return view('admin.stats', [
            'top' => array_slice(DemoData::products(), 0, 5),
            'monthly' => [
                ['mois' => 'Février', 'ca' => 680000], ['mois' => 'Mars', 'ca' => 820000],
                ['mois' => 'Avril', 'ca' => 910000], ['mois' => 'Mai', 'ca' => 1050000],
                ['mois' => 'Juin', 'ca' => 1180000], ['mois' => 'Juillet', 'ca' => 1240000],
            ],
        ]);
    }
}
