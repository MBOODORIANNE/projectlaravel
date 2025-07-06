@extends('layouts.app')

@section('content')
<h1>Détails du produit</h1>

<p><strong>Libellé :</strong> {{ $produit->libelle }}</p>
<p><strong>Description :</strong> {{ $produit->description }}</p>
<p><strong>Prix :</strong> {{ number_format($produit->prix, 2) }} FCFA</p>
<p><strong>Stock :</strong> {{ $produit->stock }}</p>
<p><strong>Statut :</strong> {{ ucfirst($produit->statut) }}</p>

@if($produit->photo)
    <p><img src="{{ asset('storage/' . $produit->photo) }}" alt="Photo du produit" style="max-width:300px"></p>
@endif

<a href="{{ route('producteur.produits.index') }}">Retour à la liste</a>
@endsection
