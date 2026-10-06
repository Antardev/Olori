<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function shipping()
    {
        return view('pages.shipping');
    }

    public function sizeGuide()
    {
        return view('pages.size-guide');
    }

    public function view360()
    {
        $products = Product::published()->latest()->get();

        return view('pages.view360', ['products' => $products]);
    }

    public function send(Request $request)
    {
        // En production : validation + envoi d'email (Mailable) ou enregistrement.
        return back()->with('status', 'Message envoyé. Nous vous répondrons sous 24 h.');
    }
}
