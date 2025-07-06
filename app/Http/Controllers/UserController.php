<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserValidated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    // Lister tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Afficher le formulaire de création d'utilisateur
    public function create()
    {
        return view('users.create');
    }

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users',
            'telephone' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'sexe' => 'required',
            'nom_utilisateur' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required|in:administrateur,producteur,consommateur',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $validated['is_validated'] = false; // Toujours false à l'inscription
        User::create($validated);
        return redirect()->route('users.index')->with('success', 'Utilisateur enregistré. En attente de validation.');
    }

    // Valider un utilisateur (ex: producteur ou consommateur)
    public function validateUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_validated = true;
        $user->save();
        // Envoyer notification mail
        $user->notify(new UserValidated());
        return redirect()->back()->with('success', 'Utilisateur validé et notification envoyée.');
    }

    // Modifier un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'telephone' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'sexe' => 'required',
            'nom_utilisateur' => 'required|unique:users,nom_utilisateur,'.$user->id,
            'role' => 'required|in:administrateur,producteur,consommateur',
        ]);
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }
        $user->update($validated);
        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour.');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }

    // Liste des utilisateurs à valider (pour l'admin)
    public function toValidate()
    {
        $users = User::where('is_validated', false)
            ->whereIn('role', ['producteur', 'consommateur'])
            ->get();
        return view('users.to_validate', compact('users'));
    }
    
public function listingProducteursParVille(Request $request)
{
    $query = \App\Models\User::where('role', 'producteur');

    if ($request->filled('ville')) {
        $query->where('ville', 'like', '%' . $request->ville . '%');
    }

    // Optionnel : paginate pour ne pas afficher trop de lignes en même temps
    $producteurs = $query->orderBy('ville')->paginate(10);

    return view('listing.producteurs.ville', compact('producteurs'));
}
}
