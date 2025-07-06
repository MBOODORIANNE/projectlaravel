@extends('layouts.app')

@section('content')
<style>
    /* Pour que body et html prennent toute la hauteur et enlèvent marges par défaut */
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, #4a90e2 0%, #50e3c2 100%);
        font-family: Arial, sans-serif;
    }

    /* Container principal qui prend toute la largeur */
    .dashboard-container {
        width: 100%;              /* Prend toute la largeur */
        max-width: 100%;          /* Pas de limite de largeur */
        margin: 0;                /* Pas de marge pour centrer */
        min-height: 100vh;        /* Au moins la hauteur de l’écran */
        padding: 30px 50px;       /* Espacement intérieur */
        background: #fff;         /* Fond blanc */
        border-radius: 0;         /* Pas d’arrondi sur tout l’écran */
        box-shadow: none;         /* Pas d’ombre */
        display: flex;            /* Flex pour menu + contenu */
        gap: 20px;                /* Espacement entre menu et contenu */
        box-sizing: border-box;   /* Padding inclus dans la largeur */
    }

    /* Sidebar Menu : fixe sa largeur */
    .sidebar {
        background-color: #283e78;
        color: white;
        padding: 20px;
        width: 280px;             /* Largeur fixe */
        border-radius: 12px;
        height: auto;
        display: flex;
        flex-direction: column;
    }
    .sidebar h3 {
        margin-bottom: 30px;
        text-align: center;
        font-weight: 700;
        font-size: 1.6rem;
    }
    .sidebar a {
        color: #a8c0ff;
        padding: 12px 15px;
        margin-bottom: 10px;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .sidebar a:hover {
        background-color: #1a2a55;
        color: #ffffff;
    }

    /* Zone principale contenu */
    .content-area {
        flex-grow: 1;             /* Prend tout l’espace restant */
        background: #f9fafb;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        display: flex;
        flex-direction: column;
    }
    .content-area h2 {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
    }

    /* Cartes produits et points de vente */
    .card {
        margin-bottom: 30px;
    }
    .card-header {
        font-weight: 700;
        font-size: 1.3rem;
    }

    /* Tableau */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    thead {
        background-color: #e9ecef;
    }
    th, td {
        padding: 12px 15px;
        border: 1px solid #dee2e6;
        text-align: left;
    }
    tbody tr:hover {
        background-color: #f1f5f9;
    }

    /* Styles badges de statut */
    .badge-status {
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.35em 0.7em;
        border-radius: 10px;
        display: inline-block;
    }
    .badge-warning {
        background-color: #f0ad4e;
        color: #4a3c1a;
    }
    .badge-success {
        background-color: #5cb85c;
        color: white;
    }
    .badge-danger {
        background-color: #d9534f;
        color: white;
    }

    /* Boutons liens */
    .btn-outline-primary, .btn-outline-info {
        font-size: 0.85rem;
        padding: 6px 12px;
        border-radius: 8px;
    }
</style>

<div class="dashboard-container">
    {{-- Menu latéral --}}
    <nav class="sidebar">
        <h3>📋 Menu</h3>
        <a href="{{ route('producteur.produits.create') }}">➕ Ajouter un produit</a>
        <a href="{{ route('producteur.produits.index') }}">📦 Mes produits</a>
        <a href="{{ route('producteur.points-de-vente.create') }}">🏬 Ajouter un point de vente</a>
        <a href="{{ route('producteur.points-de-vente.index') }}">📍 Mes points de vente</a>
    </nav>

    {{-- Zone contenu principale --}}
    <main class="content-area">
        <h2>Tableau de bord du Producteur</h2>

        {{-- Message de succès --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Produits récents --}}
        <section>
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    📦 Produits récents
                </div>
                <div class="card-body p-0">
                    @if($produits->isEmpty())
                        <p class="p-3">Aucun produit enregistré.</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prix</th>
                                    <th>Stock</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produits->take(5) as $produit)
                                    <tr>
                                        <td>{{ $produit->libelle }}</td>
                                        <td>{{ number_format($produit->prix, 0) }} FCFA</td>
                                        <td>{{ $produit->stock }}</td>
                                        <td>
                                            @php
                                                $statuts = [
                                                    'en attente' => 'badge-warning',
                                                    'valide' => 'badge-success',
                                                    'refuse' => 'badge-danger',
                                                ];
                                                $class = $statuts[$produit->statut] ?? 'badge-secondary';
                                            @endphp
                                            <span class="badge-status {{ $class }}">
                                                {{ ucfirst($produit->statut) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end p-3">
                            <a href="{{ route('producteur.produits.index') }}" class="btn btn-outline-primary btn-sm">Voir tous les produits</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- Points de vente récents --}}
        <section>
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    🏪 Points de vente récents
                </div>
                <div class="card-body p-0">
                    @if($pointsDeVente->isEmpty())
                        <p class="p-3">Aucun point de vente enregistré.</p>
                    @else
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Ville</th>
                                    <th>Quartier</th>
                                    <th>Horaires</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pointsDeVente->take(5) as $point)
                                    <tr>
                                        <td>{{ $point->nom }}</td>
                                        <td>{{ $point->ville }}</td>
                                        <td>{{ $point->quartier }}</td>
                                        <td>{{ $point->heure_ouverture }} - {{ $point->heure_fermeture }}</td>
                                        <td>
                                            @php
                                                $statutsPoints = [
                                                    'en attente' => 'badge-warning',
                                                    'valide' => 'badge-success',
                                                    'refuse' => 'badge-danger',
                                                ];
                                                $classPoint = $statutsPoints[$point->statut] ?? 'badge-secondary';
                                            @endphp
                                            <span class="badge-status {{ $classPoint }}">
                                                {{ ucfirst($point->statut) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-end p-3">
                            <a href="{{ route('producteur.points-de-vente.index') }}" class="btn btn-outline-info btn-sm">Voir tous les points de vente</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
</div>
@endsection
