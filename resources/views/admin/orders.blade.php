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
        <thead><tr><th>N°</th><th>Cliente</th><th>Date</th><th>Montant</th><th>Statut</th><th>Changer le statut</th></tr></thead>
        <tbody>
            @foreach($orders as $o)
                <tr>
                    <td>{{ $o['ref'] }}</td>
                    <td>{{ $o['client'] }}</td>
                    <td>{{ $o['date'] }}</td>
                    <td>{{ number_format($o['total'], 0, ',', ' ') }} FCFA</td>
                    <td><span class="badge {{ $statuses[$o['status']]['class'] }}">{{ $statuses[$o['status']]['label'] }}</span></td>
                    <td>
                        {{-- En production : formulaire POST → OrderController@updateStatus + email automatique --}}
                        <select class="form-select form-select-sm">
                            @foreach($statuses as $key => $s)
                                <option value="{{ $key }}" @selected($key === $o['status'])>{{ $s['label'] }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
