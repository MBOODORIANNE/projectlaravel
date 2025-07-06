<?php
namespace App\Http\Controllers; // ✅ Déclare le namespace
use App\Models\PointDeVente;
use Illuminate\Http\Request;     // ✅ Importe Request si besoin


class AdminPointDeVenteController extends Controller
{
    public function index()
{
    $enAttente = PointDeVente::where('statut', 'en attente')->get();
    $valides = PointDeVente::where('statut', 'valide')->get();
    $refuses = PointDeVente::where('statut', 'refuse')->get();

    return view('admin.points-de-vente.index', compact('enAttente', 'valides', 'refuses'));
}


    public function valider($id)
{
    $point = PointDeVente::findOrFail($id);
    $point->statut = 'valide';
    $point->save();

    return redirect()->route('admin.points-de-vente.index')->with('success', 'Le point de vente a été validé.');
}

public function refuser($id)
{
    $point = PointDeVente::findOrFail($id);
    $point->statut = 'refuse';
    $point->save();

    return redirect()->route('admin.points-de-vente.index')->with('danger', 'Le point de vente a été refusé.');
}

    public function valides()
{
    $points = \App\Models\PointDeVente::where('statut', 'valide')->get();
    return view('admin.points-de-vente.valides', compact('points'));
}

public function refuses()
{
    $points = \App\Models\PointDeVente::where('statut', 'refuse')->get();
    return view('admin.points-de-vente.refuses', compact('points'));
}

}

