<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\User;

class AdminProducteurController extends Controller
{
    /**
     * Affiche une liste des producteurs pour l'administration.
     */
    public function index()
    {
        return view('admin.producteurs.index'); // tu peux modifier selon ta vue
    }
    
    public function validerProducteur($id)
{
    $user = User::findOrFail($id);
    $user->validated = true; // ou le champ que tu utilises pour la validation
    $user->save();

    $user->notify(new ProducteurCompteValide());

    return redirect()->back()->with('success', 'Le compte producteur a été validé et la notification envoyée.');
}

public function produitsAValider()
    {
        $produits = Produit::where('statut', 'en attente')->get();
        return view('admin.produits_en_attente', compact('produits'));
    }

    public function validerProduit($id)
    {
        $produit = Produit::findOrFail($id); // ✅ correction ici
        $produit->statut = 'valide';
        $produit->save();

        return back()->with('success', 'Produit validé');
    }

    public function refuserProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->statut = 'refuse';
        $produit->save();

        return back()->with('success', 'Produit refusé');
    }

    public function produitsValidés()
    {
        $produits = Produit::where('statut', 'valide')->get();
        return view('admin.valides', compact('produits'));
    }

    public function produitsRefusés()
    {
        $produits = Produit::where('statut', 'refuse')->get();
        return view('admin.refuses', compact('produits'));
    }

}

