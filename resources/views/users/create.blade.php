@extends('layouts.app')

@section('content')
<h2>Ajouter un utilisateur</h2>
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Prénom</label>
        <input type="text" name="prenom" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Téléphone</label>
        <input type="text" name="telephone" class="form-control" required>
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
        <label>Sexe</label>
        <select name="sexe" class="form-control" required>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Nom utilisateur</label>
        <input type="text" name="nom_utilisateur" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Rôle</label>
        <select name="role" class="form-control" required>
            <option value="administrateur">Administrateur</option>
            <option value="producteur">Producteur</option>
            <option value="consommateur">Consommateur</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection
