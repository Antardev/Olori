@extends('layouts.admin')

@section('title', 'Commandes — Back-office')

@section('content')
<div class="page-head">
    <h1>Commandes</h1>
    <div>
        <button class="btn btn-ghost btn-sm" type="button"><i class="bi bi-download" aria-hidden="true"></i> Exporter CSV</button>
    </div>
</div>

<div class="card">
    <table class="data table table-hover align-middle">
        <thead><tr><th>N°</th><th>Cliente</th><th>Date</th><th>Montant</th><th>Statut</th><th>Changer le statut</th><th></th></tr></thead>
        <tbody>
            @foreach($orders as $o)
                <tr>
                    <td>{{ $o['ref'] }}</td>
                    <td>{{ $o['client'] }}</td>
                    <td>{{ $o->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($o['total'], 0, ',', ' ') }} FCFA</td>
                    <td><span class="badge {{ $statuses[$o['status']]['class'] }}">{{ $statuses[$o['status']]['label'] }}</span></td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.status', $o) }}" style="display:flex;gap:8px">
                            @csrf
                            @method('PATCH')
                            <select class="form-select form-select-sm" name="status" aria-label="Statut de la commande {{ $o->ref }}">
                                @foreach($statuses as $key => $s)
                                    <option value="{{ $key }}" @selected($key === $o['status'])>{{ $s['label'] }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary btn-sm" type="submit" aria-label="Enregistrer le statut de la commande {{ $o->ref }}" title="Enregistrer le statut">
                                <i class="bi bi-check-lg" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <a class="btn btn-ghost btn-sm" href="{{ route('admin.orders.show', $o) }}" aria-label="Voir les détails de la commande {{ $o->ref }}" title="Voir les détails">
                            <i class="bi bi-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
