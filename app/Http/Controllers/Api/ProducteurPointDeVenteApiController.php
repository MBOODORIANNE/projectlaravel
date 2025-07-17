<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointDeVente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteurPointDeVenteApiController extends Controller
{
    // ✅ Lister les points de vente du producteur connecté
    public function index()
    {
        $pointsDeVente = PointDeVente::where('user_id', Auth::id())->get();
        return response()->json($pointsDeVente);
    }

    // ✅ Ajouter un nouveau point de vente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'quartier' => 'required|string|max:255',
            'heure_ouverture' => 'required',
            'heure_fermeture' => 'required',
        ]);

        $point = PointDeVente::create([
            'user_id' => Auth::id(),
            'nom' => $validated['nom'],
            'ville' => $validated['ville'],
            'quartier' => $validated['quartier'],
            'heure_ouverture' => $validated['heure_ouverture'],
            'heure_fermeture' => $validated['heure_fermeture'],
            'statut' => 'en attente',
        ]);

        return response()->json([
            'message' => 'Point de vente créé avec succès.',
            'data' => $point
        ], 201);
    }

    // ✅ Voir un point de vente précis
    public function show($id)
    {
        $point = PointDeVente::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($point);
    }
}
