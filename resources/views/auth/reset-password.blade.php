@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe — LA MAISON')

@section('content')
<section class="auth">
    <div class="container">
        <div class="auth-panel">
            <span class="eyebrow">Espace client</span>
            <h1>Nouveau mot de passe</h1>
            @include('partials.wax-rule')

            @if ($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus>
                </div>
                <div class="field">
                    <label for="password">Nouveau mot de passe</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="field">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required>
                </div>
                <button class="btn btn-solid btn-block" type="submit">Réinitialiser</button>
            </form>
        </div>
    </div>
</section>
@endsection
