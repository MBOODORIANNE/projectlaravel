@extends('layouts.app')

@section('content')
<h2>Modifier un produit</h2>
<form method="POST" action="{{ route('produits.update', $produit->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Libellé</label>
        <input type="text" name="libelle" class="form-control" value="{{ $produit->libelle }}" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required>{{ $produit->description }}</textarea>
    </div>
    <div class="mb-3">
        <label>Prix</label>
        <input type="number" step="0.01" name="prix" class="form-control" value="{{ $produit->prix }}" required>
    </div>
    <div class="mb-3">
        <label>Photo</label>
        <input type="text" name="photo" class="form-control" value="{{ $produit->photo }}">
    </div>
    <div class="mb-3">
        <label>Catégorie</label>
        <select name="categorie_id" class="form-control" required>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}" @if($produit->categorie_id == $categorie->id) selected @endif>
                    {{ $categorie->libelle }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
