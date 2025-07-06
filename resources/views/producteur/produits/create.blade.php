@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Soumettre un nouveau produit</h2>

    <form action="{{ route('producteur.produits.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nom du produit</label>
            <input type="text" name="libelle" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label>Prix (FCFA)</label>
            <input type="number" name="prix" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control" required>
                <option value="">-- Choisir une catégorie --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->libelle }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
</div>
@endsection
