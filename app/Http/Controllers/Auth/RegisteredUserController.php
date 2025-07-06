<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Notifications\ProducteurEnAttenteVerification;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:producteur,consommateur'],
            'nom' => ['required', 'string', 'max:30'],
            'prenom' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'telephone' => ['required', 'string', 'max:15'],
            'ville' => ['required', 'string'],
            'quartier' => ['required', 'string'],
            'sexe' => ['required', 'in:Homme,Femme'],
            'nom_utilisateur' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'role' => $request->role,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'sexe' => $request->sexe,
            'nom_utilisateur' => $request->nom_utilisateur,
            'password' => Hash::make($request->password),
            'is_validated' => ($request->role === 'consommateur') ? true : false, // Les consommateurs sont validés par défaut
        ]);

        event(new Registered($user));
        if ($user->role === 'consommateur') {
            // Si c'est un consommateur, on le redirige vers son tableau de bord
            Auth::login($user);
            return redirect(route('consommateur.dashboard', absolute: false));
        }
         // Producteur : envoie l'email et redirige vers la page d'attente (sans connexion)
        $user->notify(new ProducteurEnAttenteVerification());
        return redirect(route('producteur.en.attente', absolute: false));
    }
}
