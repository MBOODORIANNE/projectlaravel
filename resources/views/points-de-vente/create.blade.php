@extends('layouts.app')

@section('content')
<h2>Ajouter un point de vente</h2>
<form method="POST" action="{{ route('points-de-vente.store') }}">
    @csrf
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Ville</label>
        <input type="text" name="ville" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Quartier</label>
        <input type="text" name="quartier" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Heure d'ouverture</label>
        <input type="time" name="heure_ouverture" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Heure de fermeture</label>
        <input type="time" name="heure_fermeture" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection
