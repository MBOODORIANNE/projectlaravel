<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\User;
use App\Notifications\ProducteurCompteValide;

class AdminProducteurApiController extends Controller
{
    // ✅ Liste des producteurs en attente
    public function producteursEnAttente()
    {
        $producteurs = User::where('role', 'producteur')->where('etat', 'en_attente')->get();
        return response()->json($producteurs);
    }

    // ✅ Valider un producteur
    public function validerProducteur($id)
    {
        $user = User::findOrFail($id);
        $user->etat = 'valide'; // ou 'validated' si tu utilises ce champ
        $user->save();

        $user->notify(new ProducteurCompteValide());

        return response()->json(['message' => 'Producteur validé et notification envoyée']);
    }

    // ✅ Liste des produits en attente
    public function produitsEnAttente()
    {
        $produits = Produit::where('statut', 'en attente')->get();
        return response()->json($produits);
    }

    // ✅ Valider un produit
    public function validerProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->statut = 'valide';
        $produit->save();

        return response()->json(['message' => 'Produit validé']);
    }

    // ✅ Refuser un produit
    public function refuserProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->statut = 'refuse';
        $produit->save();

        return response()->json(['message' => 'Produit refusé']);
    }

    // ✅ Produits validés
    public function produitsValides()
    {
        $produits = Produit::where('statut', 'valide')->get();
        return response()->json($produits);
    }

    // ✅ Produits refusés
    public function produitsRefuses()
    {
        $produits = Produit::where('statut', 'refuse')->get();
        return response()->json($produits);
    }
}
