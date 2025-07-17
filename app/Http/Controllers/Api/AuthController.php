<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'telephone' => 'required|string',
            'ville' => 'required|string',
            'quartier' => 'required|string',
            'sexe' => 'required|string|in:homme,femme',
            'nom_utilisateur' => 'required|string|unique:users,nom_utilisateur',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:producteur,consommateur,administrateur',
        ]);

        $user = User::create([
            'nom' => $fields['nom'],
            'prenom' => $fields['prenom'],
            'email' => $fields['email'],
            'telephone' => $fields['telephone'],
            'ville' => $fields['ville'],
            'quartier' => $fields['quartier'],
            'sexe' => $fields['sexe'],
            'nom_utilisateur' => $fields['nom_utilisateur'],
            'password' => bcrypt($fields['password']),
            'role' => $fields['role'],
        ]);

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = User::where('email', $fields['email'])->first() ?? User::where('nom_utilisateur', $fields['nom_utilisateur'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les informations sont incorrectes.'],
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Déconnecté avec succès'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
}
