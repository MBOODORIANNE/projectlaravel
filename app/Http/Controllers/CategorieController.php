<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required',
        ]);
        Categorie::create($validated);
        return redirect()->route('categories.index')->with('success', 'Catégorie enregistrée.');
    }
}
