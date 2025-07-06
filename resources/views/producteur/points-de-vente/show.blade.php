@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails du point de vente</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nom :</strong> {{ $point->nom }}</p>
            <p><strong>Ville :</strong> {{ $point->ville }}</p>
            <p><strong>Quartier :</strong> {{ $point->quartier }}</p>
            <p><strong>Heure d'ouverture :</strong> {{ $point->heure_ouverture }}</p>
            <p><strong>Heure de fermeture :</strong> {{ $point->heure_fermeture }}</p>
            <p><strong>Statut :</strong> 
                @if($point->statut === 'en attente')
                    <span class="text-warning">En attente</span>
                @elseif($point->statut === 'valide')
                    <span class="text-success">Validé</span>
                @elseif($point->statut === 'refuse')
                    <span class="text-danger">Refusé</span>
                @endif
            </p>
        </div>
    </div>

    <a href="{{ route('producteur.points-de-vente.index') }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection
