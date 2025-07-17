<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointDeVente;
use Illuminate\Http\Request;

class PointDeVenteApiController extends Controller
{
    public function index(Request $request)
    {
        $query = PointDeVente::query();

        // Filtre sur le statut si présent
        // if ($request->has('statut')) {
        //     $query->where('statut', $request->statut);
        // }

        $perPage = $request->input('per_page', 12);
        $points = $query->paginate($perPage);

        return response()->json([
            'data' => $points->items(),
            'total' => $points->total()
        ]);
    }

    public function show($id)
    {
        return PointDeVente::findOrFail($id);
    }

    public function store(Request $request)
    {
        $point = PointDeVente::create($request->all());
        return response()->json($point, 201);
    }

    public function update(Request $request, $id)
    {
        $point = PointDeVente::findOrFail($id);
        $point->update($request->all());
        return response()->json($point, 200);
    }

    public function destroy($id)
    {
        PointDeVente::destroy($id);
        return response()->json(null, 204);
    }
}
