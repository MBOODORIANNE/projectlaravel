<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieApiController extends Controller
{
    public function index()    { return Categorie::all(); }
    public function show($id)  { return Categorie::findOrFail($id); }
    public function store(Request $request)
    {
        $categorie = Categorie::create($request->all());
        return response()->json($categorie, 201);
    }
    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());
        return response()->json($categorie, 200);
    }
    public function destroy($id)
    {
        Categorie::destroy($id);
        return response()->json(null, 204);
    }
}