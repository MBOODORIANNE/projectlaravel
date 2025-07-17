<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteurProduitController extends Controller
{
    // Liste des produits du producteur connecté (GET /api/producteur/produits)
    public function index()
    {
        $user = Auth::user();
        $produits = Produit::where('user_id', $user->id)->get();

        return response()->json([
            'success' => true,
            'data' => $produits
        ]);
    }

    // Affiche un produit spécifique (GET /api/producteur/produits/{id})
    public function show($id)
    {
        $user = Auth::user();
        $produit = Produit::where('user_id', $user->id)->find($id);

        if (!$produit) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé ou accès refusé.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $produit
        ]);
    }

    // Création d'un produit (POST /api/producteur/produits)
    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $validatedData['user_id'] = $user->id;
        $validatedData['statut'] = Produit::STATUT_ATTENTE;

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('produits', 'public');
        }

        $produit = Produit::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Produit créé, en attente de validation.',
            'data' => $produit
        ], 201);
    }

    // Optionnel : update, delete, etc. peuvent être ajoutés selon besoin
}
