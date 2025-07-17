<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\PointDeVente;
use Illuminate\Support\Facades\Auth;

class DashboardApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'administrateur') {
            return $this->admin();
        } elseif ($user->role === 'producteur') {
            return $this->producteur();
        } elseif ($user->role === 'consommateur') {
            return $this->consommateur();
        }

        return response()->json(['error' => 'Accès non autorisé'], 403);
    }

    public function admin()
    {
        $nbProducteurs = User::where('role', 'producteur')->count();
        $nbProduits = Produit::count();
        $nbDemandes = User::where('role', 'producteur')->where('is_validated', false)->count();
        $tauxValid = $nbProducteurs > 0
            ? round(User::where('role', 'producteur')->where('is_validated', true)->count() / $nbProducteurs * 100)
            : 0;
        $tauxProduits = $nbProduits > 0
            ? round(Produit::where('stock', '>', 0)->count() / $nbProduits * 100)
            : 0;

        $pointsVenteCount = PointDeVente::count();
        $consommateursCount = User::where('role', 'consommateur')->count();

        $producteursValidesListe = User::where('role', 'producteur')
            ->where('is_validated', true)
            ->with('produits')
            ->paginate(10);

        $producteursValides = $producteursValidesListe->total();
        $producteursNonValides = $nbProducteurs - $producteursValides;

        return response()->json([
            'nbProducteurs' => $nbProducteurs,
            'produitsCount' => $nbProduits,
            'nbDemandes' => $nbDemandes,
            'tauxValid' => $tauxValid,
            'tauxProduits' => $tauxProduits,
            'categories' => Categorie::all(),
            'categoriesCount' => Categorie::count(),
            'pointsVenteCount' => $pointsVenteCount,
            'producteursCount' => $nbProducteurs,
            'consommateursCount' => $consommateursCount,
            'producteursValides' => $producteursValides,
            'producteursNonValides' => $producteursNonValides,
            'producteursValidesListe' => $producteursValidesListe
        ]);
    }

    public function producteur()
    {
        $user = Auth::user();

        return response()->json([
            'produits' => $user->produits,
            'pointsDeVente' => $user->pointsDeVente
        ]);
    }

    public function consommateur()
    {
        $produits = Produit::where('statut', 'valide')->get();
        $pointsDeVente = PointDeVente::where('statut', 'valide')->get();

        return response()->json([
            'produits' => $produits,
            'pointsDeVente' => $pointsDeVente
        ]);
    }
}
