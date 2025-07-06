@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Producteurs par ville</h2>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('listing.producteurs.ville') }}" class="mb-3 d-flex gap-2 align-items-center" style="max-width: 400px;">
        <input type="text" name="ville" placeholder="Ville" value="{{ request('ville') }}" class="form-control">
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <!-- Table des producteurs -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-success">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Quartier</th>
                </tr>
            </thead>
            <tbody>
                @forelse($producteurs as $producteur)
                    <tr>
                        <td>{{ $producteur->nom }}</td>
                        <td>{{ $producteur->prenom }}</td>
                        <td>{{ $producteur->email }}</td>
                        <td>{{ $producteur->ville }}</td>
                        <td>{{ $producteur->quartier }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun producteur trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $producteurs->appends(request()->query())->links() }}
    </div>
</div>
@endsection
