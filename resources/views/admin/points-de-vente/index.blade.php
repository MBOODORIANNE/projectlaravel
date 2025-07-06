@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- Alertes de session --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    {{-- Points en attente --}}
    <h2 class="mb-4">🕒 Points de Vente en Attente</h2>
    @if($enAttente->isEmpty())
        <div class="alert alert-secondary">Aucun point de vente en attente.</div>
    @else
        <div class="card shadow-sm rounded mb-4">
            <div class="card-body">
                <table class="table table-bordered align-middle table-striped">
                    <thead class="table-warning">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Ville</th>
                            <th>Quartier</th>
                            <th>Heures</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enAttente as $index => $point)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $point->nom }}</td>
                                <td>{{ $point->ville }}</td>
                                <td>{{ $point->quartier }}</td>
                                <td>{{ $point->heure_ouverture }} - {{ $point->heure_fermeture }}</td>
                                <td>
                                    <form action="{{ route('admin.points-de-vente.valider', $point->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">✔ Valider</button>
                                    </form>

                                    <form action="{{ route('admin.points-de-vente.refuser', $point->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm">✘ Refuser</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- Points validés --}}
    <h4 class="mt-5 text-success">🟢 Points de Vente Validés</h4>
    @if($valides->isEmpty())
        <p class="text-muted">Aucun point validé.</p>
    @else
        <ul class="list-group mb-4">
            @foreach ($valides as $point)
                <li class="list-group-item">
                    <strong>{{ $point->nom }}</strong> — {{ $point->ville }} ({{ $point->quartier }})
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Points refusés --}}
    <h4 class="mt-4 text-danger">🔴 Points de Vente Refusés</h4>
    @if($refuses->isEmpty())
        <p class="text-muted">Aucun point refusé.</p>
    @else
        <ul class="list-group">
            @foreach ($refuses as $point)
                <li class="list-group-item">
                    <strong>{{ $point->nom }}</strong> — {{ $point->ville }} ({{ $point->quartier }})
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
