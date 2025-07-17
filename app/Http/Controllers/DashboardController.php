<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\PointDeVente;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'administrateur') {
            return $this->admin();
        } elseif ($user->role === 'producteur') {
            return $this->producteur(); // ✅ Appel de la bonne méthode
        } elseif ($user->role === 'consommateur') {
            return view('dashboard.consommateur');
        }

        abort(403);
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

    $pointsVenteCount = \App\Models\PointDeVente::count();
    $consommateursCount = User::where('role', 'consommateur')->count();

    // 👉 Liste paginée des producteurs validés avec leurs produits (10 par page)
    $producteursValidesListe = User::where('role', 'producteur')
        ->where('is_validated', true)
        ->with('produits') // Assure-toi que la relation existe dans User.php
        ->paginate(10);

    $producteursValides = $producteursValidesListe->total();
    $producteursNonValides = $nbProducteurs - $producteursValides;

    return view('dashboard.admin', [
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
        'producteursValidesListe' => $producteursValidesListe,
    ]);
}
public function producteur()
{
    $user = auth()->user();
    $produits = $user->produits ?? collect();
    $pointsDeVente = $user->pointsDeVente ?? collect();

    return view('dashboard.producteur', compact('produits', 'pointsDeVente'));
}


public function consommateur()
{
    $produits = Produit::where('statut', 'valide')->get();
    $pointsDeVente = PointDeVente::where('statut', 'valide')->get();

    return view('dashboard.consommateur', compact('produits', 'pointsDeVente'));
}


}


