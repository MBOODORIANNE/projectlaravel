<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitApiController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return response()->json([
            'data' => $produits,
            'total' => $produits->count()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'photo' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $validated['user_id'] = Auth::id(); // Utilisateur connecté
        $produit = Produit::create($validated);

        return response()->json($produit, 201);
    }

    public function show($id)
    {
        $produit = Produit::with('categorie')->findOrFail($id);
        return response()->json($produit);
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $validated = $request->validate([
            'libelle' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'photo' => 'nullable|string',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit->update($validated);

        return response()->json($produit);
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return response()->json(['message' => 'Produit supprimé avec succès.']);
    }

    // ✅ Listing par catégorie
    public function listingParCategorie($categorie_id)
    {
        $produits = Produit::where('categorie_id', $categorie_id)->get();

        return response()->json($produits);
    }
}
