<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\PointDeVente;

class ProducteurController extends Controller
{
    /**
     * Affiche le formulaire de création de produit.
     */
    public function createProduit()
    {
        return view('producteur.create_produit');
    }

    /**
     * Affiche le formulaire de création de point de vente.
     */
    public function createPoint()
    {
        return view('producteur.create_point');
    }

    /**
     * Enregistre un nouveau produit.
     */         
public function storeProduit(Request $request)
{
    try {
        $request->validate([
            'libelle' => 'required',
            'description' => 'nullable',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('libelle', 'description', 'prix', 'stock');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('produits', 'public');
        }

        $data['is_validated'] = false;
        $data['is_refused'] = false;

        $request->user()->produits()->create($data);

        return back()->with('success', 'Votre produit a été transmis à l\'administrateur pour validation.');
    } catch (\Exception $e) {
        return back()->with('error', 'Une erreur est survenue lors de l\'enregistrement du produit.');
    }
}

    public function storePoint(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
        ]);

        $request->user()->pointsDeVente()->create($request->only('nom', 'adresse'));

        return back()->with('success', 'Point de vente ajouté avec succès.');
    }
}