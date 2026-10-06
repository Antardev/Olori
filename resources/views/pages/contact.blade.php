@extends('layouts.app')

@section('title', 'Contact — LA MAISON')

@section('content')
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Nous écrire</span>
                <h2>Contact</h2>
            </div>
        </div>

        <div class="checkout-layout">
            <form method="POST" action="{{ route('contact.send') }}">
                @csrf
                <div class="form-grid">
                    <div class="field"><label for="cname">Nom</label><input id="cname" name="name" required></div>
                    <div class="field"><label for="cmail">Email</label><input id="cmail" name="email" type="email" required></div>
                    <div class="field full"><label for="csubj">Sujet</label><input id="csubj" name="subject" placeholder="Question sur une commande, un produit…"></div>
                    <div class="field full"><label for="cmsg">Message</label><textarea id="cmsg" name="message" rows="6" required></textarea></div>
                </div>
                <button class="btn btn-terra" type="submit" style="margin-top:18px">Envoyer le message</button>
            </form>

            <aside class="panel">
                <h3>Nos coordonnées</h3>
                <p style="font-size:15px;line-height:2">
                    Cotonou, Quartier Menontin<br>
                    contact@lamaison.bj<br>
                    +229 97 00 00 00<br><br>
                    <strong>Réseaux sociaux</strong><br>
                    Instagram · Facebook · TikTok
                </p>
              
            </aside>
        </div>
    </div>
</section>
@endsection
