@extends('layouts.app') {{-- ou ton layout d'administration --}}

@section('content')
<div class="container">
    <h2>Produits en attente de validation</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($produits->isEmpty())
        <p>Aucun produit en attente.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Catégorie</th>
                    <th>Producteur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->libelle }}</td>
                        <td>{{ $produit->description }}</td>
                        <td>{{ $produit->prix }} FCFA</td>
                        <td>{{ $produit->categorie->nom ?? 'Non défini' }}</td>
                        <td>{{ $produit->user->name ?? 'Inconnu' }}</td>
                        <td>
                            {{-- Formulaire de validation --}}
                            <form action="{{ route('admin.valider', $produit->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                <button class="btn btn-success btn-sm" onclick="return confirm('Valider ce produit ?')">Valider</button>
                            </form>

                            {{-- Formulaire de refus --}}
                            <form action="{{ route('admin.refuser', $produit->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Refuser ce produit ?')">Refuser</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
