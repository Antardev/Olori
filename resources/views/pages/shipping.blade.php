@extends('layouts.app')

@section('title', 'Livraison & retours — LA MAISON')
@section('meta_description', 'Informations sur la livraison et les retours des commandes LA MAISON.')

@section('content')
<section class="section">
    <div class="container" style="max-width:900px">
        <span class="eyebrow">Besoin d'aide</span>
        <h1 style="margin:18px 0 24px">Livraison <em>& retours</em></h1>

        <div class="checkout-layout">
            <div>
                <h2 style="font-size:2rem;margin-bottom:16px">Livraison</h2>
                <p style="margin-bottom:18px">Chaque commande est préparée avec soin dans notre atelier de Cotonou. Vous recevez les informations de suivi dès que votre colis est remis au transporteur.</p>
                <table class="data table table-hover align-middle">
                    <thead><tr><th>Destination</th><th>Délai estimé</th><th>Frais</th></tr></thead>
                    <tbody>
                        <tr><td>Cotonou</td><td>48 heures ouvrées</td><td>1 500 FCFA</td></tr>
                        <tr><td>Reste du Bénin</td><td>3 à 5 jours ouvrés</td><td>Sur confirmation</td></tr>
                        <tr><td>International</td><td>7 à 12 jours ouvrés</td><td>Sur devis</td></tr>
                    </tbody>
                </table>
                <p style="margin-top:16px;font-size:14px;color:var(--encre-70)">Les délais peuvent varier pendant les périodes de forte activité. Une adresse complète et un numéro joignable sont nécessaires pour la livraison.</p>
            </div>

            <aside class="panel">
                <h3>Retours</h3>
                <p style="margin-top:12px">Vous disposez de 7 jours après réception pour demander un retour.</p>
                <ul style="list-style:disc;margin:14px 0 0 20px">
                    <li>Article non porté, non lavé et avec ses étiquettes.</li>
                    <li>Retour accompagné de la preuve de commande.</li>
                    <li>Les pièces personnalisées ou retouchées ne sont pas reprises.</li>
                </ul>
                <p style="margin-top:16px">Écrivez-nous via la page <a class="lien-souligne" href="{{ route('contact') }}">Contact</a> pour recevoir les instructions de retour.</p>
            </aside>
        </div>
    </div>
</section>
@endsection
