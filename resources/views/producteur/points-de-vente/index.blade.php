@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Mes points de vente</h2>

    @if(session('success'))
        <div class="alert alert-success text-center fs-5">
            {{ session('success') }}
        </div>
    @endif

    @if($pointsDeVente->isEmpty())
        <div class="alert alert-warning text-center">Vous n'avez soumis aucun point de vente.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>Quartier</th>
                    <th>Horaires</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pointsDeVente as $point)
                    <tr>
                        <td>{{ $point->nom }}</td>
                        <td>{{ $point->ville }}</td>
                        <td>{{ $point->quartier }}</td>
                        <td>{{ $point->heure_ouverture }} - {{ $point->heure_fermeture }}</td>
                        <td>
                            @php
                                $statuts = [
                                    'en attente' => 'warning text-dark',
                                    'valide' => 'success',
                                    'refuse' => 'danger',
                                ];
                                $class = $statuts[$point->statut] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $class }}">
                                {{ ucfirst($point->statut) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
