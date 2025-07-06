<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PointDeVente;
use Illuminate\Http\Request;

class PointDeVenteApiController extends Controller
{
    public function index()    { return PointDeVente::all(); }
    public function show($id)  { return PointDeVente::findOrFail($id); }
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