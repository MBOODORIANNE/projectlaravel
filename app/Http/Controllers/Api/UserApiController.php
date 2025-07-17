<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    // Liste paginée des producteurs
    public function indexProducteurs(Request $request)
    {
        $query = User::where('role', 'producteur');

        // Filtres éventuels (statut, pagination, etc.)
        if ($request->has('statut')) {
            $query->where('etat', $request->statut);
        }

        $perPage = $request->input('per_page', 12);
        $producteurs = $query->paginate($perPage);

        return response()->json([
            'data' => $producteurs->items(),
            'total' => $producteurs->total()
        ]);
    }
}
