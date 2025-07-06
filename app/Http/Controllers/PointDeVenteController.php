<?php

namespace App\Http\Controllers;

use App\Models\PointDeVente;
use Illuminate\Http\Request;

class PointDeVenteController extends Controller
{
    // Lister tous les points de vente
    public function index()
    {
        $points = PointDeVente::all();
        return view('points-de-vente.index', compact('points'));
    }

    // Formulaire de création
    public function create()
    {
        return view('points-de-vente.create');
    }

    // Enregistrement d’un point de vente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'ville' => 'required',
            'quartier' => 'required',
            'heure_ouverture' => 'required',
            'heure_fermeture' => 'required',
        ]);

        PointDeVente::create($validated);

        return redirect()->route('points-de-vente.index')->with('success', 'Point de vente enregistré.');
    }

    // Affichage d’un point de vente
    public function show(PointDeVente $points)
    {
        return view('points-de-vente.show', compact('points'));
    }

    // Formulaire d’édition
   public function edit($id)
{
    $points = PointDeVente::findOrFail($id);
    return view('points-de-vente.edit', compact('points'));
}

    // Mise à jour d’un point de vente
    public function update(Request $request, $id)
{
    $points = PointDeVente::findOrFail($id); // récupère manuellement

    $validated = $request->validate([
        'nom' => 'required',
        'ville' => 'required',
        'quartier' => 'required',
        'heure_ouverture' => 'required',
        'heure_fermeture' => 'required',
    ]);

    $points->update($validated);

    return redirect()->route('points-de-vente.index')->with('success', 'Point de vente mis à jour.');
}

// Suppression d’un point de vente

public function destroy($id)
{
    $points = PointDeVente::findOrFail($id);
    $points->delete();

    return redirect()->route('points-de-vente.index')->with('success', 'Point de vente supprimé.');
}

    // Recherche dans les points de vente
    public function search(Request $request)
    {
        $query = $request->input('query');

        $points = PointDeVente::where('nom', 'like', "%{$query}%")
            ->orWhere('ville', 'like', "%{$query}%")
            ->orWhere('quartier', 'like', "%{$query}%")
            ->get();

        return view('points-de-vente.index', compact('points'));
    }
}
