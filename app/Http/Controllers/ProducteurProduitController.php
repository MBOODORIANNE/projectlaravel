<?php
// app/Http/Controllers/ProducteurProduitController.php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteurProduitController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $produits = Produit::where('user_id', $user->id)->get();

        return view('producteur.produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('producteur.produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only(['libelle', 'description', 'prix', 'stock', 'categorie_id']);
        $data['user_id'] = Auth::id();
        $data['statut'] = Produit::STATUT_ATTENTE;

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('produits', 'public');
        }

        Produit::create($data);

        return redirect()->route('producteur.produits.index')->with('success', 'Produit créé, en attente de validation.');
    }
}
