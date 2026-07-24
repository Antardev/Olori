<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Redirige l'administrateur vers son tableau de bord,
     * les autres utilisateurs vers l'accueil.
     */
    public function toResponse($request): RedirectResponse|JsonResponse
    {
        if ($request->wantsJson()) {
            return new JsonResponse('', 204);
        }

        $user = $request->user();

        $redirect = $user && $user->isAdmin()
            ? route('admin.dashboard')
            : route('home');

        return redirect()->intended($redirect);
    }
}
