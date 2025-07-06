@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🟢 Points de Vente Validés</h2>

    @if($points->isEmpty())
        <div class="alert alert-info">Aucun point de vente validé pour le moment.</div>
    @else
    <div class="card shadow-sm rounded">
        <div class="card-body">
            <table class="table table-hover table-striped align-middle">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Ville</th>
                        <th>Quartier</th>
                        <th>Heure Ouverture</th>
                        <th>Heure Fermeture</th>
                        <th>Date Validation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($points as $index => $point)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $point->nom }}</td>
                            <td>{{ $point->ville }}</td>
                            <td>{{ $point->quartier }}</td>
                            <td>{{ $point->heure_ouverture }}</td>
                            <td>{{ $point->heure_fermeture }}</td>
                            <td>{{ $point->updated_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
