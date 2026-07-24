@extends('layouts.app')

@section('title', 'Connexion — LA MAISON')

@section('content')
<section class="section" style="min-height:70vh; display:flex; align-items:center; justify-content:center;">
    <div class="container" style="max-width:480px; width:100%;">
        <div class="panel" style="padding:32px;">
            <h3 style="text-align:center; margin-bottom:24px;">Connexion</h3>

            @if (session('status'))
                <div class="flash" role="status" style="margin-bottom:16px">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert" role="alert" style="margin-bottom:16px; color:#b00020; font-size:14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="field" style="margin-bottom:14px">
                    <label for="lemail">Email</label>
                    <input id="lemail" name="email" type="email" value="{{ old('email') }}" placeholder="nom@exemple.com" required autofocus>
                </div>
                <div class="field" style="margin-bottom:14px">
                    <label for="lpass">Mot de passe</label>
                    <input id="lpass" name="password" type="password" required>
                </div>
                <div class="field" style="margin-bottom:18px; display:flex; align-items:center; gap:8px;">
                    <input id="remember" name="remember" type="checkbox" style="width:auto">
                    <label for="remember" style="margin:0">Se souvenir de moi</label>
                </div>
                <button class="btn btn-solid btn-block" type="submit">Se connecter</button>
            </form>

            <p style="margin-top:14px;font-size:14px;text-align:center">
                <a href="{{ route('password.request') }}" style="text-decoration:underline">Mot de passe oublié ?</a>
            </p>
            <p style="margin-top:18px;font-size:14px;text-align:center; color:#4E463C;">
                Vous n'avez pas de compte ? <a href="{{ route('register') }}" style="text-decoration:underline; font-weight:600;">Créer un compte</a>
            </p>
        </div>
    </div>
</section>
@endsection
