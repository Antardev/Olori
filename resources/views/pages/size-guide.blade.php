@extends('layouts.app')

@section('title', 'Guide des tailles — LA MAISON')
@section('meta_description', 'Trouvez votre taille pour les vêtements LA MAISON. Mesures, conseils et tableau comparatif.')

@section('content')
<section class="py-5">
    <div class="container" style="max-width: 1000px;">

        {{-- En-tête --}}
        <div class="text-center mb-5">
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill text-uppercase fw-normal" style="letter-spacing: 1px; font-size: 0.85rem;">
                <i class="fas fa-ruler-combined me-2"></i>Bien choisir
            </span>
            <h1 class="display-5 fw-light mt-3 mb-2">
                Guide des <em class="text-primary" style="font-style: italic; color: #b8a089 !important;">tailles</em>
            </h1>
            <p class="lead text-muted mx-auto" style="max-width: 680px;">
                Prenez vos mesures avec un mètre souple, sans serrer. Si vous êtes entre deux tailles, choisissez la plus grande pour une coupe plus confortable.
            </p>
        </div>

        {{-- Section "Comment mesurer ?" --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-tshirt fa-2x text-primary mb-2" style="color: #b8a089 !important;"></i>
                        <h5 class="card-title">Tour de poitrine</h5>
                        <p class="card-text small text-muted">Mesurez au point le plus fort de la poitrine, en gardant le mètre horizontal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-utensils fa-2x text-primary mb-2" style="color: #b8a089 !important;"></i>
                        <h5 class="card-title">Tour de taille</h5>
                        <p class="card-text small text-muted">Au creux de la taille, naturellement, sans rentrer le ventre.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-3">
                    <div class="card-body">
                        <i class="fas fa-walking fa-2x text-primary mb-2" style="color: #b8a089 !important;"></i>
                        <h5 class="card-title">Tour de hanches</h5>
                        <p class="card-text small text-muted">Au point le plus large des hanches et des fesses, mètre bien horizontal.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tableaux --}}
        <div class="row g-5">

            {{-- Femmes --}}
            <div class="col-12 col-lg-6">
                <h2 class="h4 fw-light d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-female" style="color: #b8a089;"></i> Femmes
                </h2>
                <div class="table-responsive">
                    <table class="table table-hover align-middle shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-tag me-1"></i> Taille</th>
                                <th><i class="fas fa-tshirt me-1"></i> Poitrine</th>
                                <th><i class="fas fa-utensils me-1"></i> Taille</th>
                                <th><i class="fas fa-walking me-1"></i> Hanches</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>XS / 34</td><td>80–84 cm</td><td>62–66 cm</td><td>86–90 cm</td></tr>
                            <tr><td>S / 36</td><td>84–88 cm</td><td>66–70 cm</td><td>90–94 cm</td></tr>
                            <tr><td>M / 38</td><td>88–94 cm</td><td>70–76 cm</td><td>94–100 cm</td></tr>
                            <tr><td>L / 40</td><td>94–100 cm</td><td>76–82 cm</td><td>100–106 cm</td></tr>
                            <tr><td>XL / 42</td><td>100–106 cm</td><td>82–88 cm</td><td>106–112 cm</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Hommes --}}
            <div class="col-12 col-lg-6">
                <h2 class="h4 fw-light d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-male" style="color: #b8a089;"></i> Hommes
                </h2>
                <div class="table-responsive">
                    <table class="table table-hover align-middle shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-tag me-1"></i> Taille</th>
                                <th><i class="fas fa-tshirt me-1"></i> Poitrine</th>
                                <th><i class="fas fa-utensils me-1"></i> Taille</th>
                                <th><i class="fas fa-walking me-1"></i> Hanches</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>S</td><td>88–94 cm</td><td>76–82 cm</td><td>90–96 cm</td></tr>
                            <tr><td>M</td><td>94–100 cm</td><td>82–88 cm</td><td>96–102 cm</td></tr>
                            <tr><td>L</td><td>100–106 cm</td><td>88–94 cm</td><td>102–108 cm</td></tr>
                            <tr><td>XL</td><td>106–112 cm</td><td>94–100 cm</td><td>108–114 cm</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Accessoires et conseil --}}
        <div class="row g-4 mt-4">
            <div class="col-md-8">
                <div class="card border-0 bg-light p-4">
                    <div class="d-flex align-items-start gap-3">
                        <i class="fas fa-gem fa-2x text-primary" style="color: #b8a089 !important;"></i>
                        <div>
                            <h3 class="h5 fw-bold">Accessoires</h3>
                            <p class="mb-0 text-muted">
                                Les accessoires sont proposés en taille unique ou selon les dimensions indiquées sur leur fiche produit.
                                Pour une question sur une pièce, notre équipe vous répond via la page <a href="{{ route('contact') }}" class="text-decoration-underline" style="color: #b8a089;">Contact</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 bg-primary bg-opacity-10 h-100 d-flex align-items-center justify-content-center text-center p-3" style="background-color: #f5f0eb !important;">
                    <i class="fas fa-question-circle fa-2x mb-2" style="color: #b8a089;"></i>
                    <p class="mb-0 small fw-bold">Une hésitation ?<br>
                    <a href="{{ route('contact') }}" class="text-decoration-underline" style="color: #b8a089;">Contactez-nous</a></p>
                </div>
            </div>
        </div>

        {{-- Note supplémentaire --}}
        <div class="alert alert-secondary border-0 mt-4" role="alert" style="background-color: #faf8f6; color: #5a4f47;">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Conseil :</strong> Pour les vêtements amples, privilégiez la taille supérieure. Nos pièces sont conçues pour épouser naturellement la silhouette.
        </div>

    </div>
</section>
@endsection
