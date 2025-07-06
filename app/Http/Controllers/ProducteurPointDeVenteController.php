<?php

namespace App\Http\Controllers;

use App\Models\PointDeVente;
use Illuminate\Http\Request;

class ProducteurPointDeVenteController extends Controller
{
    // Lister les points de vente du producteur connecté
    public function index()
    {
        $pointsDeVente = PointDeVente::where('user_id', auth()->id())->get();
        return view('producteur.points-de-vente.index', compact('pointsDeVente'));
    }

    // Affiche le formulaire d’ajout
    public function create()
    {
        return view('producteur.points-de-vente.create');
    }

    // Enregistrement d’un point de vente
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'quartier' => 'required|string|max:255',
            'heure_ouverture' => 'required',
            'heure_fermeture' => 'required',
        ]);

        PointDeVente::create([
            'user_id' => auth()->id(),
            'nom' => $request->nom,
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'heure_ouverture' => $request->heure_ouverture,
            'heure_fermeture' => $request->heure_fermeture,
            'statut' => 'en attente',
        ]);

        return redirect()->route('producteur.points-de-vente.index')
                         ->with('success', 'Point de vente soumis avec succès. En attente de validation.');
    }

    // Voir un point de vente spécifique (optionnel)
    public function show($id)
    {
        $point = PointDeVente::where('user_id', auth()->id())->findOrFail($id);
        return view('producteur.points-de-vente.show', compact('point'));
    }
}
