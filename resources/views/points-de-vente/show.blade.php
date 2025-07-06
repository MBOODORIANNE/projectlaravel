@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Détails du Point de Vente</h2>

    <div class="card">
        <div class="card-header bg-success text-white">
            <strong>{{ $pointDeVente->nom }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Adresse :</strong> {{ $pointDeVente->adresse }}</p>
            <p><strong>Ville :</strong> {{ $pointDeVente->ville }}</p>
            <p><strong>Quartier :</strong> {{ $pointDeVente->quartier }}</p>
            <p><strong>Contact :</strong> {{ $pointDeVente->telephone }}</p>

            {{-- Si tu as d'autres champs, tu peux les ajouter ici --}}
        </div>
        <div class="card-footer">
            <a href="{{ route('points-de-vente.index') }}" class="btn btn-primary">Retour à la liste</a>
            <a href="{{ route('points-de-vente.edit', $pointDeVente->id) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
