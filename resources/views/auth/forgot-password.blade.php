@extends('layouts.app')

@section('title', 'Mot de passe oublié — LA MAISON')

@section('content')
<section class="section" style="min-height:70vh; display:flex; align-items:center; justify-content:center;">
    <div class="container" style="max-width:480px; width:100%;">
        <div class="panel" style="padding:32px;">
            <h3 style="text-align:center; margin-bottom:16px;">Mot de passe oublié</h3>
            <p style="font-size:14px;color:#4E463C;margin-bottom:20px;text-align:center;">
                Indiquez votre email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>

            @if (session('status'))
                <div class="flash" role="status" style="margin-bottom:16px">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert" role="alert" style="margin-bottom:16px; color:#b00020; font-size:14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="field" style="margin-bottom:18px">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="nom@exemple.com" required autofocus>
                </div>
                <button class="btn btn-solid btn-block" type="submit">Envoyer le lien</button>
            </form>

            <p style="margin-top:18px;font-size:14px;text-align:center">
                <a href="{{ route('login') }}" style="text-decoration:underline">Retour à la connexion</a>
            </p>
        </div>
    </div>
</section>
@endsection
