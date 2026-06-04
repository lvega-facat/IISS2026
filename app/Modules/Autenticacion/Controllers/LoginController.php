<?php

namespace App\Modules\Autenticacion\Controllers;

use App\Modules\Autenticacion\Actions\GestionarIntentoFallidoAction;
use App\Modules\Autenticacion\Actions\LoginAction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController
{
    public function show()
    {
        return response('Login endpoint', 200);
    }

    public function store(
        Request $request,
        LoginAction $loginAction,
        GestionarIntentoFallidoAction $gestionIntentoFallidoAction
    ): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $result = $loginAction->attempt(
            $credentials['email'],
            $credentials['password'],
            $request->ip(),
            $request->userAgent(),
            $request->path(),
        );

        if ($result['status'] === 'success') {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        if ($result['status'] === 'blocked') {
            return back()
                ->withErrors(['email' => $result['message']])
                ->onlyInput('email');
        }

        if ($result['status'] === 'invalid_credentials' && $result['user'] !== null) {
            $gestionIntentoFallidoAction->handle(
                $result['user'],
                $request->ip(),
                $request->path(),
            );
        }

        return back()
            ->withErrors(['email' => $result['message']])
            ->onlyInput('email');
    }
}