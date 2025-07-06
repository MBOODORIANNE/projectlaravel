@extends('layouts.app')

@section('content')
<h2>Modifier un utilisateur</h2>
<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="{{ $user->nom }}" required>
    </div>
    <div class="mb-3">
        <label>Prénom</label>
        <input type="text" name="prenom" class="form-control" value="{{ $user->prenom }}" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label>Téléphone</label>
        <input type="text" name="telephone" class="form-control" value="{{ $user->telephone }}" required>
    </div>
    <div class="mb-3">
        <label>Ville</label>
        <input type="text" name="ville" class="form-control" value="{{ $user->ville }}" required>
    </div>
    <div class="mb-3">
        <label>Quartier</label>
        <input type="text" name="quartier" class="form-control" value="{{ $user->quartier }}" required>
    </div>
    <div class="mb-3">
        <label>Sexe</label>
        <select name="sexe" class="form-control" required>
            <option value="Homme" @if($user->sexe == 'Homme') selected @endif>Homme</option>
            <option value="Femme" @if($user->sexe == 'Femme') selected @endif>Femme</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Nom utilisateur</label>
        <input type="text" name="nom_utilisateur" class="form-control" value="{{ $user->nom_utilisateur }}" required>
    </div>
    <div class="mb-3">
        <label>Mot de passe (laisser vide pour ne pas changer)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Rôle</label>
        <select name="role" class="form-control" required>
            <option value="administrateur" @if($user->role == 'administrateur') selected @endif>Administrateur</option>
            <option value="producteur" @if($user->role == 'producteur') selected @endif>Producteur</option>
            <option value="consommateur" @if($user->role == 'consommateur') selected @endif>Consommateur</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
