@extends('layouts.app')

@section('content')
<h2>Ajouter un produit</h2>
<form method="POST" action="{{ route('produits.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Libellé</label>
        <input type="text" name="libelle" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Prix</label>
        <input type="number" step="0.01" name="prix" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Photo</label>
        <input type="file" name="photo" class="form-control">
    </div>
    <div class="mb-3">
        <label>Catégorie</label>
        <select name="categorie_id" class="form-control" required>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection
