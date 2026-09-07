@extends('layouts.admin')

@section('title', 'Commande '.$order->ref.' — Back-office')

@section('content')
<div class="page-head">
    <div>
        <h1>Commande {{ $order->ref }}</h1>
        <p class="page-sub">Passée le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
    </div>
    <a class="btn btn-ghost" href="{{ route('admin.orders') }}"><i class="bi bi-arrow-left" aria-hidden="true"></i> Retour aux commandes</a>
</div>

<div class="form-grid">
    <section class="card">
        <h2>Informations client</h2>
        <p><strong>{{ $order->customer_name }}</strong></p>
        <p>{{ $order->email }}<br>{{ $order->phone }}</p>
        <p>{{ $order->address }}<br>{{ $order->city }}</p>
    </section>

    <section class="card">
        <h2>Commande</h2>
        <p>Statut : <span class="badge {{ $statuses[$order->status]['class'] ?? 'badge-warning' }}">{{ $statuses[$order->status]['label'] ?? $order->status }}</span></p>
        <form method="POST" action="{{ route('admin.orders.status', $order) }}" style="display:flex;gap:8px;margin-top:14px">
            @csrf
            @method('PATCH')
            <select class="form-select form-select-sm" name="status" aria-label="Nouveau statut de la commande {{ $order->ref }}">
                @foreach($statuses as $key => $status)
                    <option value="{{ $key }}" @selected($key === $order->status)>{{ $status['label'] }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary btn-sm" type="submit" title="Enregistrer le statut">
                <i class="bi bi-check-lg" aria-hidden="true"></i>
                Enregistrer
            </button>
        </form>
        <p>Paiement : {{ $order->payment_method === 'kkiapay' ? 'KKiaPay' : $order->payment_method }}</p>
        @if($order->promotion_code)
            <p>Code promo : <strong>{{ $order->promotion_code }}</strong></p>
        @endif
    </section>
</div>

<section class="card" style="margin-top:20px">
    <h2>Articles commandés</h2>
    <table class="data table table-hover align-middle">
        <thead><tr><th>Article</th><th>Quantité</th><th>Prix</th><th>Total</th></tr></thead>
        <tbody>
            @foreach($order->items ?? [] as $item)
                <tr>
                    <td>{{ $item['product']['name'] ?? 'Article supprimé' }}</td>
                    <td>{{ $item['qty'] ?? 0 }}</td>
                    <td>{{ number_format($item['product']['price'] ?? 0, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($item['line'] ?? 0, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="summary" style="max-width:360px;margin:20px 0 0 auto">
        <div class="row"><span>Sous-total</span><span>{{ number_format($order->subtotal, 0, ',', ' ') }} FCFA</span></div>
        @if($order->discount)
            <div class="row"><span>Remise</span><span>-{{ number_format($order->discount, 0, ',', ' ') }} FCFA</span></div>
        @endif
        <div class="row"><span>Livraison</span><span>{{ number_format($order->shipping, 0, ',', ' ') }} FCFA</span></div>
        <div class="row total"><span>Total</span><span>{{ number_format($order->total, 0, ',', ' ') }} FCFA</span></div>
    </div>
</section>
@endsection
