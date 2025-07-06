@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">🏪 Ajouter un point de vente</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('producteur.points-de-vente.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du point de vente</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" name="ville" id="ville" class="form-control" value="{{ old('ville') }}" required>
        </div>

        <div class="mb-3">
            <label for="quartier" class="form-label">Quartier</label>
            <input type="text" name="quartier" id="quartier" class="form-control" value="{{ old('quartier') }}" required>
        </div>

        <div class="mb-3">
            <label for="heure_ouverture" class="form-label">Heure d'ouverture</label>
            <input type="time" name="heure_ouverture" id="heure_ouverture" class="form-control" value="{{ old('heure_ouverture') }}" required>
        </div>

        <div class="mb-3">
            <label for="heure_fermeture" class="form-label">Heure de fermeture</label>
            <input type="time" name="heure_fermeture" id="heure_fermeture" class="form-control" value="{{ old('heure_fermeture') }}" required>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">✅ Soumettre</button>
        </div>
    </form>
</div>
@endsection
