@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📦 Mes Produits</h2>
        <a href="{{ route('producteur.produits.create') }}" class="btn btn-primary">➕ Ajouter un produit</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($produits->isEmpty())
        <div class="alert alert-info">
            Aucun produit enregistré.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Photo</th>
                        <th>Libellé</th>
                        <th>Prix (FCFA)</th>
                        <th>Stock</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr>
                            <td>
                                @if($produit->photo)
                                    <img src="{{ asset('storage/' . $produit->photo) }}" alt="Produit" width="60" height="60" style="object-fit: cover;">
                                @else
                                    <span class="text-muted">Aucune</span>
                                @endif
                            </td>
                            <td>{{ $produit->libelle }}</td>
                            <td>{{ number_format($produit->prix, 0, ',', ' ') }}</td>
                            <td>{{ $produit->stock }}</td>
                            <td>{{ $produit->categorie->libelle ?? '-' }}</td>
                            <td>
                                @php
                                    $statutClasses = [
                                        'en attente' => 'badge bg-warning text-dark',
                                        'valide' => 'badge bg-success',
                                        'refuse' => 'badge bg-danger',
                                    ];
                                    $class = $statutClasses[$produit->statut] ?? 'badge bg-secondary';
                                @endphp
                                <span class="{{ $class }}">{{ ucfirst($produit->statut) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
