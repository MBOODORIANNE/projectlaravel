<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la vue de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Traite la demande de connexion.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Vérifie si le compte est validé par l'administrateur
        if (!$user->is_validated) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Votre compte n\'a pas encore été validé par l\'administrateur.');
        }

        // Redirection selon le rôle
        switch ($user->role) {
            case 'administrateur':
                return redirect()->intended('/admin/dashboard');
            case 'producteur':
                return redirect()->intended('/producteur/dashboard');
            case 'consommateur':
                return redirect()->intended('/consommateur/dashboard');
            default:
                return redirect()->intended('/dashboard');
        }
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
