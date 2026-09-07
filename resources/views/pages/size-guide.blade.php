@extends('layouts.app')

@section('title', 'Guide des tailles — LA MAISON')
@section('meta_description', 'Trouvez votre taille pour les vêtements LA MAISON.')

@section('content')
<section class="section">
    <div class="container" style="max-width:900px">
        <span class="eyebrow">Bien choisir</span>
        <h1 style="margin:18px 0 20px">Guide des <em>tailles</em></h1>
        <p style="max-width:680px;margin-bottom:34px">Prenez vos mesures avec un mètre souple, sans serrer. Si vous êtes entre deux tailles, choisissez la plus grande pour une coupe plus confortable.</p>

        <h2 style="font-size:2rem;margin-bottom:16px">Femmes</h2>
        <div style="overflow-x:auto;margin-bottom:42px">
            <table class="data table table-hover align-middle">
                <thead><tr><th>Taille</th><th>Tour de poitrine</th><th>Tour de taille</th><th>Tour de hanches</th></tr></thead>
                <tbody>
                    <tr><td>XS / 34</td><td>80–84 cm</td><td>62–66 cm</td><td>86–90 cm</td></tr>
                    <tr><td>S / 36</td><td>84–88 cm</td><td>66–70 cm</td><td>90–94 cm</td></tr>
                    <tr><td>M / 38</td><td>88–94 cm</td><td>70–76 cm</td><td>94–100 cm</td></tr>
                    <tr><td>L / 40</td><td>94–100 cm</td><td>76–82 cm</td><td>100–106 cm</td></tr>
                    <tr><td>XL / 42</td><td>100–106 cm</td><td>82–88 cm</td><td>106–112 cm</td></tr>
                </tbody>
            </table>
        </div>

        <h2 style="font-size:2rem;margin-bottom:16px">Hommes</h2>
        <div style="overflow-x:auto;margin-bottom:34px">
            <table class="data table table-hover align-middle">
                <thead><tr><th>Taille</th><th>Tour de poitrine</th><th>Tour de taille</th><th>Tour de hanches</th></tr></thead>
                <tbody>
                    <tr><td>S</td><td>88–94 cm</td><td>76–82 cm</td><td>90–96 cm</td></tr>
                    <tr><td>M</td><td>94–100 cm</td><td>82–88 cm</td><td>96–102 cm</td></tr>
                    <tr><td>L</td><td>100–106 cm</td><td>88–94 cm</td><td>102–108 cm</td></tr>
                    <tr><td>XL</td><td>106–112 cm</td><td>94–100 cm</td><td>108–114 cm</td></tr>
                </tbody>
            </table>
        </div>

        <div class="panel">
            <h3>Accessoires</h3>
            <p style="margin-top:10px">Les accessoires sont proposés en taille unique ou selon les dimensions indiquées sur leur fiche produit. Pour une question sur une pièce, notre équipe vous répond via la page <a class="lien-souligne" href="{{ route('contact') }}">Contact</a>.</p>
        </div>
    </div>
</section>
@endsection
