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
                <h3 style="margin-top:22px">FAQ</h3>
                <div class="accordion">
                    <details><summary>Quels sont les délais de livraison ?</summary><div class="body">48 h à Cotonou, 3 à 5 jours au Bénin, 7 à 12 jours à l'international.</div></details>
                    <details><summary>Comment payer ma commande ?</summary><div class="body">Par KKiaPay (Mobile Money, carte bancaire) ou à la livraison à Cotonou.</div></details>
                    <details><summary>Puis-je retourner un article ?</summary><div class="body">Oui, sous 7 jours après réception, article non porté.</div></details>
                </div>
            </aside>
        </div>
    </div>
</section>
@endsection
