@extends('layouts.app')

@section('content')
<h2>Produits par catégorie</h2>
<form method="GET" action="{{ route('listing.produits.categories') }}" class="mb-3">
    <select name="categorie_id" class="form-control" style="width:200px;display:inline;">
        <option value="">Toutes les catégories</option>
        @foreach($categories as $categorie)
            <option value="{{ $categorie->id }}" @if(request('categorie_id') == $categorie->id) selected @endif>
                {{ $categorie->libelle }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">Filtrer</button>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Libellé</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Catégorie</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produits as $produit)
        <tr>
            <td>{{ $produit->libelle }}</td>
            <td>{{ $produit->description }}</td>
            <td>{{ $produit->prix }}</td>
            <td>{{ $produit->categorie->libelle ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
