<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitApiController extends Controller
{
    public function index()    { return Produit::all(); }
    public function show($id)  { return Produit::findOrFail($id); }
    public function store(Request $request)
    {
        $produit = Produit::create($request->all());
        return response()->json($produit, 201);
    }
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $produit->update($request->all());
        return response()->json($produit, 200);
    }
    public function destroy($id)
    {
        Produit::destroy($id);
        return response()->json(null, 204);
    }
}