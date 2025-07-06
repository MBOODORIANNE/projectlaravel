@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier un point de vente</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erreur !</strong> Veuillez corriger les champs suivants :<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('points-de-vente.update', $points->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="{{ old('nom', $points->nom) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="ville">Ville</label>
            <input type="text" name="ville" value="{{ old('ville', $points->ville) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="quartier">Quartier</label>
            <input type="text" name="quartier" value="{{ old('quartier', $points->quartier) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="heure_ouverture">Heure d'ouverture</label>
            <input type="time" name="heure_ouverture" value="{{ old('heure_ouverture', $points->heure_ouverture) }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="heure_fermeture">Heure de fermeture</label>
            <input type="time" name="heure_fermeture" value="{{ old('heure_fermeture', $points->heure_fermeture) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('points-de-vente.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
