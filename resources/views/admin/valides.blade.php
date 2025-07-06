@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Produits validés</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($produits->isEmpty())
        <p>Aucun produit validé pour le moment.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Producteur</th>
                    <th>Prix</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->libelle }}</td>
                        <td>{{ $produit->user->name ?? 'Inconnu' }}</td>
                        <td>{{ number_format($produit->prix, 2) }} FCFA</td>
                        <td>
                            <span class="badge bg-success">Validé</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
