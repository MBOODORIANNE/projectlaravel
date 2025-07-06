@extends('layouts.app')

@section('content')
<h2>Liste des produits</h2>
<a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Libellé</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produits as $produit)
        <tr>
            <td>{{ $produit->libelle }}</td>
            <td>{{ $produit->description }}</td>
            <td>{{ $produit->prix }}</td>
            <td>{{ $produit->categorie->libelle ?? '' }}</td>
            <td>
                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
