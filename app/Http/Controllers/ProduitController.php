<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'photo' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        $validated['user_id'] = auth()->id(); // Assurez-vous que l'utilisateur est authentifié
        Produit::create($validated);
        return redirect()->route('produits.index')->with('success', 'Produit enregistré.');
    }

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $validated = $request->validate([
            'libelle' => 'required',
            'description' => 'required',
            'prix' => 'required|numeric',
            'photo' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);
        $produit->update($validated);
        return redirect()->route('produits.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé.');
    }
    
public function listingParCategorie(Request $request)
{
    $categories = Categorie::all();

    $query = Produit::query();

    if ($request->categorie_id) {
        $query->where('categorie_id', $request->categorie_id);
    }

    $produits = $query->get();

    return view('listing.produits.categories', compact('categories', 'produits'));
}

}
