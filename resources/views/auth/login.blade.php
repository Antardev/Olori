@extends('layouts.app')

@section('title', 'Connexion — LA MAISON')

@section('content')
<section class="auth">
    <div class="container">
        <div class="auth-panel">
            <span class="eyebrow">Espace client</span>
            <h1>Connexion</h1>
            @include('partials.wax-rule')

            @if (session('status'))
                <div class="flash" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field">
                    <label for="lemail">Email</label>
                    <input id="lemail" name="email" type="email" value="{{ old('email') }}" placeholder="nom@exemple.com" required autofocus>
                </div>
                <div class="field">
                    <label for="lpass">Mot de passe</label>
                    <input id="lpass" name="password" type="password" required>
                </div>
                <div class="field-inline">
                    <input id="remember" name="remember" type="checkbox">
                    <label for="remember">Se souvenir de moi</label>
                </div>
                <button class="btn btn-solid btn-block" type="submit">Se connecter</button>
            </form>

            <div class="auth-liens">
                <p><a href="{{ route('password.request') }}">Mot de passe oublié ?</a></p>
                <p>Pas encore de compte ? <a href="{{ route('register') }}">Créer un compte</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
