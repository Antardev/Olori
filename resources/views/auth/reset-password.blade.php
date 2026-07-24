@extends('layouts.app')

@section('title', 'Réinitialiser le mot de passe — LA MAISON')

@section('content')
<section class="section" style="min-height:70vh; display:flex; align-items:center; justify-content:center;">
    <div class="container" style="max-width:480px; width:100%;">
        <div class="panel" style="padding:32px;">
            <h3 style="text-align:center; margin-bottom:20px;">Nouveau mot de passe</h3>

            @if ($errors->any())
                <div class="alert" role="alert" style="margin-bottom:16px; color:#b00020; font-size:14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="field" style="margin-bottom:14px">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus>
                </div>
                <div class="field" style="margin-bottom:14px">
                    <label for="password">Nouveau mot de passe</label>
                    <input id="password" name="password" type="password" required>
                </div>
                <div class="field" style="margin-bottom:18px">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required>
                </div>
                <button class="btn btn-solid btn-block" type="submit">Réinitialiser</button>
            </form>
        </div>
    </div>
</section>
@endsection
