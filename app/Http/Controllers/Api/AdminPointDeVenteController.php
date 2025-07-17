<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointDeVente;
use Illuminate\Http\Request;

class AdminPointDeVenteController extends Controller
{
    // Liste des points de vente par statut
    public function index()
    {
        $enAttente = PointDeVente::where('statut', 'en attente')->get();
        $valides = PointDeVente::where('statut', 'valide')->get();
        $refuses = PointDeVente::where('statut', 'refuse')->get();

        return response()->json([
            'enAttente' => $enAttente,
            'valides' => $valides,
            'refuses' => $refuses,
        ]);
    }

    // Valider un point de vente
    public function valider($id)
    {
        $point = PointDeVente::findOrFail($id);
        $point->statut = 'valide';
        $point->save();

        return response()->json(['message' => 'Le point de vente a été validé.', 'point' => $point]);
    }

    // Refuser un point de vente
    public function refuser($id)
    {
        $point = PointDeVente::findOrFail($id);
        $point->statut = 'refuse';
        $point->save();

        return response()->json(['message' => 'Le point de vente a été refusé.', 'point' => $point]);
    }

    // Points de vente validés
    public function valides()
    {
        $points = PointDeVente::where('statut', 'valide')->get();
        return response()->json(['points' => $points]);
    }

    // Points de vente refusés
    public function refuses()
    {
        $points = PointDeVente::where('statut', 'refuse')->get();
        return response()->json(['points' => $points]);
    }
}
