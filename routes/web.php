<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PointDeVenteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminProducteurController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProducteurProduitController;
use App\Http\Controllers\ProducteurPointDeVenteController;
use App\Http\Controllers\AdminPointDeVenteController;

// ...existing code...

// ✅ Routes publiques
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');

Route::get('/a-propos', function () {
    return view('a_propos');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['middleware' => ['auth', 'roleuser:administrateur']], function () {
    // Routes pour l'administrateur
    Route::post('/admin/producteurs/{id}/valider', [AdminProducteurController::class, 'validerProducteur'])->name('admin.producteurs.valider');
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    Route::get('/admin/producteurs', [AdminProducteurController::class, 'index'])->name('admin.producteurs.index');
     // Liste des points de vente
   Route::get('/points-de-vente', [PointDeVenteController::class, 'index'])->name('points-de-vente.index');
Route::get('/points-de-vente/create', [PointDeVenteController::class, 'create'])->name('points-de-vente.create');
Route::post('/points-de-vente', [PointDeVenteController::class, 'store'])->name('points-de-vente.store');
Route::get('/points-de-vente/{id}/edit', [PointDeVenteController::class, 'edit'])->name('points-de-vente.edit');
Route::put('/points-de-vente/{id}', [PointDeVenteController::class, 'update'])->name('points-de-vente.update');
Route::delete('/points-de-vente/{id}', [PointDeVenteController::class, 'destroy'])->name('points-de-vente.destroy');
Route::get('/points-de-vente/{id}', [PointDeVenteController::class, 'show'])->name('points-de-vente.show');

      // Catégories (CRUD)
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');

// Produits (CRUD)
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');
Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');

    // Routes pour la validation des utilisateurs
    Route::get('/users/to-validate', [App\Http\Controllers\UserController::class, 'toValidate'])->name('users.to_validate');
    Route::post('/users/{id}/validate', [App\Http\Controllers\UserController::class, 'validateUser'])->name('users.validate');
    Route::get('/admin/produits', [App\Http\Controllers\AdminProducteurController::class, 'produitsAValider'])->name('admin.a_valider');
   // Liste des produits à valider
Route::get('/admin/attente', [AdminProducteurController::class, 'produitsAValider'])->name('admin.a_valider');
Route::post('/admin/{id}/valider', [AdminProducteurController::class, 'validerProduit'])->name('admin.valider');
Route::post('/admin/{id}/refuser', [AdminProducteurController::class, 'refuserProduit'])->name('admin.refuser');
Route::get('/admin/a-valider', [AdminProducteurController::class, 'produitsAValider'])->name('admin.a_valider');
Route::get('/admin/valides', [AdminProducteurController::class, 'produitsValidés'])->name('admin.valides');
Route::get('/admin/refuses', [AdminProducteurController::class, 'produitsRefusés'])->name('admin.refuses');
// Liste des points de vente à valider
 Route::get('/admin/points-de-vente', [AdminPointDeVenteController::class, 'index'])->name('admin.points-de-vente.index');
 Route::put('/admin/points-de-vente/{id}/valider', [AdminPointDeVenteController::class, 'valider'])->name('admin.points-de-vente.valider');
Route::put('/admin/points-de-vente/{id}/refuser', [AdminPointDeVenteController::class, 'refuser'])->name('admin.points-de-vente.refuser');
 Route::get('/admin/points-de-vente/valides', [AdminPointDeVenteController::class, 'valides'])->name('admin.points-de-vente.valides');
 Route::get('/admin/points-de-vente/refuses', [AdminPointDeVenteController::class, 'refuses'])->name('admin.points-de-vente.refuses');

});

// Routes pour les producteurs
Route::group(['middleware' => [ 'auth', 'roleuser:producteur', 'producteur.validated']], function () {

    Route::get('/producteur/dashboard', [DashboardController::class, 'producteur'])->name('producteur.dashboard');
    Route::get('/producteur/dashboard', [DashboardController::class, 'producteur'])->name('producteur.dashboard');
     Route::get('/producteur/produits', [ProducteurProduitController::class, 'index'])->name('producteur.produits.index');
    Route::get('/producteur/produits/create', [ProducteurProduitController::class, 'create'])->name('producteur.produits.create');
    Route::post('/producteur/produits', [ProducteurProduitController::class, 'store'])->name('producteur.produits.store');
    Route::get('/producteur/produits/{id}', [ProducteurProduitController::class, 'show'])->name('producteur.produits.show');
    Route::get('/producteur/points-de-vente', [ProducteurPointDeVenteController::class, 'index'])->name('producteur.points-de-vente.index');
    Route::get('/producteur/points-de-vente/create', [ProducteurPointDeVenteController::class, 'create'])->name('producteur.points-de-vente.create');
    Route::post('/producteur/points-de-vente', [ProducteurPointDeVenteController::class, 'store'])->name('producteur.points-de-vente.store');
     Route::get('/producteur/points-de-vente/{points}', [ProducteurPointDeVenteController::class, 'show'])->name('producteur.points-de-vente.show');
});
Route::get('/producteur/en-attente', function () {
    return view('listing.producteurs.producteur_enattente');
})->name('producteur.en.attente');
 // Routes pour les consommateurs
   // ✅ Routes accessibles uniquement par les administrateurs et consommateurs
Route::group(['middleware' => ['auth', 'roleuser:consommateur,administrateur']], function () {
    Route::get('/consommateur/dashboard', [DashboardController::class, 'consommateur'])->name('consommateur.dashboard');
    Route::get('/listing/produits/categories', [ProduitController::class, 'listingParCategorie'])->name('listing.produits.categories');
    Route::get('/listing/producteurs/ville', [UserController::class, 'listingProducteursParVille'])->name('listing.producteurs.ville');
});

// ✅ Routes accessibles uniquement par les producteurs validés
Route::middleware(['auth', 'roleuser:producteur', 'producteur.validated'])->group(function () {
    Route::get('/producteur/dashboard', [DashboardController::class, 'producteur'])->name('producteur.dashboard');
    // Autres routes du producteur ici
});


// Ajout explicite des routes login/register (optionnel si auth.php est déjà inclus)

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])
    ->middleware('guest');

require __DIR__.'/auth.php';
