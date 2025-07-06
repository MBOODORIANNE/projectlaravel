@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des points de vente</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('points-de-vente.create') }}" class="btn btn-primary mb-3">Ajouter un point de vente</a>

    @if($points->isEmpty())
        <p>Aucun point de vente trouvé.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Quartier</th>
                    <th>Heure ouverture</th>
                    <th>Heure fermeture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($points as $point)
                    <tr>
                        <td>{{ $point->nom }}</td>
                        <td>{{ $point->ville }}</td>
                        <td>{{ $point->quartier }}</td>
                        <td>{{ $point->heure_ouverture }}</td>
                        <td>{{ $point->heure_fermeture }}</td>
                        <td>
                            <a href="{{ route('points-de-vente.edit', $point->id) }}" class="btn btn-sm btn-primary">Modifier</a>

                            <form action="{{ route('points-de-vente.destroy', $point->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
