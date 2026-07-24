@extends('layouts.app')

@section('title', 'Commande confirmée — LA MAISON')

@section('content')
<section class="section">
    <div class="container">
        <div class="confirm-box">
            <div class="check">✓</div>
            <h2 style="margin:12px 0">Merci, {{ $order['name'] }} !</h2>
            <p>Votre commande <strong>{{ $order['ref'] }}</strong> est confirmée.
               Un email récapitulatif vient de vous être envoyé, suivi d'un second email lors de l'expédition.</p>
            <p style="margin:16px 0 26px;color:#4E463C">
                Mode de paiement : {{ $order['payment'] === 'kkiapay' ? 'KKiaPay (payé)' : 'Paiement à la livraison' }}
            </p>
            <a class="btn btn-solid" href="{{ route('shop.index') }}">Continuer mes achats</a>
        </div>
    </div>
</section>
@endsection
