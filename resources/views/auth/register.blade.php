@extends('layouts.app')

@section('title', 'Créer un compte — LA MAISON')

@section('content')
<section class="section">
    <div class="container" style="max-width:920px">
        <div class="panel" style="max-width:560px; margin:0 auto;">
            <h3>Créer un compte</h3>
            <p style="font-size:15px;color:#4E463C;margin-bottom:16px">Créez votre compte pour suivre vos commandes, enregistrer vos adresses et sauvegarder vos favoris.</p>

            @if ($errors->any())
                <div class="alert" role="alert" style="margin-bottom:16px; color:#b00020; font-size:14px;">
                    <ul style="margin:0; padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="field" style="margin-bottom:14px"><label for="name">Nom</label><input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus></div>
                <div class="field" style="margin-bottom:14px"><label for="remail">Email</label><input id="remail" name="email" type="email" value="{{ old('email') }}" required></div>
                <div class="field" style="margin-bottom:14px"><label for="rpass">Mot de passe</label><input id="rpass" name="password" type="password" required></div>
                <div class="field" style="margin-bottom:18px"><label for="rpassconfirm">Confirmer le mot de passe</label><input id="rpassconfirm" name="password_confirmation" type="password" required></div>
                <button class="btn btn-solid btn-block" type="submit">S'inscrire</button>
            </form>
            <p style="margin-top:14px;font-size:14px;text-align:center"><a href="{{ route('login') }}" style="text-decoration:underline">J'ai déjà un compte</a></p>
        </div>
    </div>
</section>
@endsection
