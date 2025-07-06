<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProduitApiController;
use App\Http\Controllers\Api\CategorieApiController;
use App\Http\Controllers\Api\PointDeVenteApiController;
use App\Http\Controllers\Api\AdminProducteurApiController;
use App\Http\Controllers\Api\AdminPointDeVenteController;
use App\Http\Controllers\Api\ProducteurProduitController;
use App\Http\Controllers\Api\ProducteurPointDeVenteApiController;
use App\Http\Controllers\Api\ProducteurPointDeVenteController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // ADMIN
    Route::middleware('roleuser:administrateur')->group(function () {
        Route::get('/admin/dashboard', fn () => response()->json(['message' => 'Admin Dashboard']));

        Route::get('/admin/producteurs', [AdminProducteurApiController::class, 'index']);
        Route::post('/admin/producteurs/{id}/valider', [AdminProducteurApiController::class, 'validerProducteur']);

        Route::get('/admin/produits/attente', [AdminProducteurApiController::class, 'produitsAValider']);
        Route::post('/admin/produits/{id}/valider', [AdminProducteurApiController::class, 'validerProduit']);
        Route::post('/admin/produits/{id}/refuser', [AdminProducteurApiController::class, 'refuserProduit']);
        Route::get('/admin/produits/valides', [AdminProducteurApiController::class, 'produitsValides']);
        Route::get('/admin/produits/refuses', [AdminProducteurApiController::class, 'produitsRefuses']);

        Route::get('/admin/points-de-vente', [AdminPointDeVenteApiController::class, 'index']);
        Route::put('/admin/points-de-vente/{id}/valider', [AdminPointDeVenteController::class, 'valider']);
        Route::put('/admin/points-de-vente/{id}/refuser', [AdminPointDeVenteController::class, 'refuser']);
        Route::get('/admin/points-de-vente/valides', [AdminPointDeVenteController::class, 'valides']);
        Route::get('/admin/points-de-vente/refuses', [AdminPointDeVenteController::class, 'refuses']);
    });

    // PRODUCTEUR
    Route::middleware(['roleuser:producteur', 'producteur.validated'])->group(function () {
        Route::get('/producteur/dashboard', fn () => response()->json(['message' => 'Producteur Dashboard']));

        Route::apiResource('/producteur/produits', ProducteurProduitApiController::class);
        Route::apiResource('/producteur/points-de-vente', ProducteurPointDeVenteApiController::class);
    });

    // CONSOMMATEUR + ADMIN
    Route::middleware(['roleuser:consommateur,administrateur'])->group(function () {
        Route::get('/consommateur/dashboard', fn () => response()->json(['message' => 'Consommateur Dashboard']));
        Route::get('/listing/produits/categories', [ProduitApiController::class, 'listingParCategorie']);
        Route::get('/listing/producteurs/ville', [AdminProducteurApiController::class, 'listingProducteursParVille']);
    });

    // COMMUNS
    Route::apiResource('/produits', ProduitApiController::class)->only(['index', 'show']);
    Route::apiResource('/categories', CategorieApiController::class)->only(['index', 'show']);
    Route::apiResource('/points-de-vente', PointDeVenteApiController::class)->only(['index', 'show']);
});
