@extends('layouts.app')

@section('title', 'Mot de passe oublié — LA MAISON')

@section('content')
<section class="auth">
    <div class="container">
        <div class="auth-panel">
            <span class="eyebrow">Espace client</span>
            <h1>Mot de passe oublié</h1>
            @include('partials.wax-rule')

            <p class="auth-intro">Indiquez votre email : nous vous envoyons un lien pour choisir un nouveau mot de passe.</p>

            @if (session('status'))
                <div class="flash" role="status">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nom@exemple.com" required autofocus>
                </div>
                <button class="btn btn-solid btn-block" type="submit">Envoyer le lien</button>
            </form>

            <div class="auth-liens">
                <p><a href="{{ route('login') }}">Retour à la connexion</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
