<?php

namespace App\Http\Controllers;

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
        // Chaque séquence : slug, titre, dossier des frames, nombre de vues.
        $sets = [
            ['slug' => 'robe-signature', 'title' => 'Robe Signature', 'frames' => 24],
            ['slug' => 'robe-ife',       'title' => 'Robe Ifè',       'frames' => 24],
        ];

        return view('pages.view360', ['sets' => $sets]);
    }

    public function send(Request $request)
    {
        // En production : validation + envoi d'email (Mailable) ou enregistrement.
        return back()->with('status', 'Message envoyé. Nous vous répondrons sous 24 h.');
    }
}
