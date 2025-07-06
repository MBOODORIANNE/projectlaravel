<?php
namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProducteurProduitController extends Controller
{
    // Liste des produits du producteur connecté
    public function index()
    {
        $user = Auth::user();
        $produits = Produit::where('user_id', $user->id)->get();

        return view('producteur.produits.index', compact('produits'));
    }

    // Affiche un produit spécifique
    public function show($id)
    {
        $user = Auth::user();
        $produit = Produit::where('user_id', $user->id)->findOrFail($id);

        return view('producteur.produits.show', compact('produit'));
    }

    // Formulaire de création
    public function create()
    {
        $categories = Categorie::all(); // ✅ Récupération des catégories
        return view('producteur.produits.create', compact('categories'));
    }

    // Sauvegarde un nouveau produit
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = $request->only(['libelle', 'description', 'prix', 'stock', 'categorie_id']);
        $data['user_id'] = $user->id;
        $data['statut'] = Produit::STATUT_ATTENTE; // Assure-toi que cette constante existe

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('produits', 'public');
        }

        Produit::create($data);

        return redirect()->route('producteur.produits.index')->with('success', 'Produit créé, en attente de validation.');
    }
}
