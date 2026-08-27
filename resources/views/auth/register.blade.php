@extends('layouts.app')

@section('title', 'Créer un compte — LA MAISON')

@section('content')
<section class="auth">
    <div class="container">
        <div class="auth-panel">
            <span class="eyebrow">Espace client</span>
            <h1>Créer un compte</h1>
            @include('partials.wax-rule')

            <p class="auth-intro">Suivez vos commandes, enregistrez vos adresses et gardez vos pièces favorites sous la main.</p>

            @if ($errors->any())
                <div class="alert" role="alert">
                    <ul class="alert-liste">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field"><label for="name">Nom</label><input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus></div>
                <div class="field"><label for="remail">Email</label><input id="remail" name="email" type="email" value="{{ old('email') }}" required></div>
                <div class="field"><label for="rpass">Mot de passe</label><input id="rpass" name="password" type="password" required></div>
                <div class="field"><label for="rpassconfirm">Confirmer le mot de passe</label><input id="rpassconfirm" name="password_confirmation" type="password" required></div>
                <button class="btn btn-solid btn-block" type="submit">Créer mon compte</button>
            </form>

            <div class="auth-liens">
                <p>Déjà cliente ou client ? <a href="{{ route('login') }}">Se connecter</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
