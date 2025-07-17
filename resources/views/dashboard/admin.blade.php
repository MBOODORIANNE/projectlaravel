@extends('layouts.app')

@section('content')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* ---------------------
       Sidebar (navigation)
       --------------------- */
    .sidebar {
        position: fixed; /* Fixée pour rester visible */
        top: 0;
        left: 0;
        height: 100vh; /* Pleine hauteur */
        width: 450px;
        background-color:rgba(31, 204, 97, 0.84); /* Bleu Bootstrap */
        padding-top: 20px;
        border-right: 2px solidrgb(27, 172, 70);
        overflow-y: auto;
        z-index: 1000;
    }
    .sidebar a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }
    .sidebar a:hover {
        background-color: #0b5ed7;
        border-radius: 5px;
    }
    .sidebar ul {
        list-style: none;
        padding-left: 0;
    }
    .sidebar ul ul {
        padding-left: 1rem; /* Indentation sous-menus */
    }

    /* --------------------
       Main content (dashboard)
       -------------------- */
    .main-content {
        margin-left: 220px; /* Décalage à droite de la sidebar */
        padding: 30px;
        background-color: #f8f9fa; /* Gris très clair */
        min-height: 100vh; /* Pour toujours prendre toute la hauteur */
    }

    /* -----------------
       Cartes statistiques
       ----------------- */
    .dashboard-card {
        border-radius: 10px;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.1);
        transition: transform 0.2s ease;
        cursor: default;
    }
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgb(0 0 0 / 0.2);
    }
    .dashboard-card h5 {
        font-weight: 600;
    }

    /* -------------
       Tableau styles
       ------------- */
    table thead {
        background-color:rgb(48, 202, 69);
        color: white;
    }
    table tbody tr:nth-child(odd) {
        background-color: #e9ecef;
    }

    /* -------------
       Titres sections
       ------------- */
    h2, h4 {
        font-weight: 700;
        margin-bottom: 1rem;
    }

    /* -------------
       Formulaire recherche
       ------------- */
    .search-form {
        max-width: 400px;
        margin-bottom: 2rem;
    }
</style>

<div class="sidebar">
    <ul>
        <li><a href="{{ route('admin.dashboard') }}"><ion-icon name="home-outline"></ion-icon>&nbsp; Accueil</a></li>
        <li><a href="{{ route('categories.index') }}"><ion-icon name="grid-outline"></ion-icon>&nbsp; Catégories</a></li>
        <li><a href="{{ route('produits.index') }}"><ion-icon name="cube-outline"></ion-icon>&nbsp; Produits</a></li>
        <li><a href="{{ route('points-de-vente.index')}}"><ion-icon name="business-outline"></ion-icon>&nbsp; PointsdeVente</a></li>
        <li><a href="{{ route('listing.produits.categories') }}"><ion-icon name="list-outline"></ion-icon>&nbsp; Produits par Catégorie</a></li>
        <li><a href="{{ route('listing.producteurs.ville') }}"><ion-icon name="map-outline"></ion-icon>&nbsp; Producteurs par Ville</a></li>
        <li><a href="{{ route('users.to_validate') }}"><ion-icon name="checkmark-done-outline"></ion-icon>&nbsp; Producteurs à valider</a></li>
        <li><a href="{{ route('admin.a_valider') }}"><ion-icon name="alert-circle-outline"></ion-icon>&nbsp; Produits à valider</a></li>
        <ul>
            <li><a href="{{ route('admin.valides') }}">Produits validés</a></li>
            <li><a href="{{ route('admin.refuses') }}">Produits refusés</a></li>
        </ul>
        <!-- Points de vente à valider -->
        <li><a href="{{ route('admin.points-de-vente.index') }}"><ion-icon name="storefront-outline"></ion-icon>&nbsp; Points de Vente à valider</a></li>
        <ul style="margin-left: 20px;">
            <li><a href="{{ route('admin.points-de-vente.valides') }}"><ion-icon name="checkmark-outline"></ion-icon>&nbsp; Points validés</a></li>
            <li><a href="{{ route('admin.points-de-vente.refuses') }}"><ion-icon name="close-outline"></ion-icon>&nbsp; Points refusés</a></li>
        </ul>
        <li><a href="{{ route('logout') }}"><ion-icon name="log-out-outline"></ion-icon>&nbsp; Déconnexion</a></li>
    </ul>
</div>

<div class="main-content">
    <h2>📊 Tableau de bord Administrateur</h2>

    {{-- Cartes statistiques --}}
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white dashboard-card text-center p-3">
                <h5>Produits</h5>
                <p class="display-6">{{ $produitsCount ?? '0' }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white dashboard-card text-center p-3">
                <h5>Catégories</h5>
                <p class="display-6">{{ $categoriesCount ?? '0' }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark dashboard-card text-center p-3">
                <h5>Points de Vente</h5>
                <p class="display-6">{{ $pointsVenteCount ?? '0' }}</p>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card bg-dark text-white dashboard-card text-center p-3">
                <h5>Producteurs</h5>
                <p class="display-6">{{ $nbProducteurs ?? '0' }}</p>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card bg-info text-white dashboard-card text-center p-3">
                <h5>Consommateurs</h5>
                <p class="display-6">{{ $consommateursCount ?? '0' }}</p>
            </div>
        </div>
    </div>

    {{-- Graphique état des producteurs --}}
    <div class="mt-5 mb-5 p-4 bg-white rounded shadow-sm">
        <h4>État des Producteurs</h4>
        <canvas id="producteursChart" width="300" height="300"></canvas>
    </div>

    {{-- Formulaire de recherche --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="search-form">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un producteur..." value="{{ request('search') }}">
            <button class="btn btn-outline-primary" type="submit">Rechercher</button>
        </div>
    </form>

    {{-- Tableau des producteurs validés et leurs produits --}}
    <div class="table-responsive bg-white rounded shadow-sm p-4">
        <h4>Producteurs Validés et leurs Produits</h4>
        <table class="table table-striped table-bordered align-middle">
            <thead>
                <tr>
                    <th>Nom Producteur</th>
                    <th>Email</th>
                    <th>Produits</th>
                </tr>
            </thead>
            <tbody>
                @forelse($producteursValidesListe as $producteur)
                    <tr>
                        <td>{{ $producteur->name }}</td>
                        <td>{{ $producteur->email }}</td>
                        <td>
                            @if($producteur->produits->isEmpty())
                                <span class="text-muted">Aucun produit</span>
                            @else
                                <ul class="mb-0 ps-3">
                                    @foreach($producteur->produits as $produit)
                                        <li>{{ $produit->libelle }} ({{ number_format($produit->prix, 0, ',', ' ') }} FCFA)</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Aucun producteur validé trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('producteursChart').getContext('2d');
    const producteursChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Validés', 'Non Validés'],
            datasets: [{
                label: 'Producteurs',
                data: [{{ $producteursValides ?? 0 }}, {{ $producteursNonValides ?? 0 }}],
                backgroundColor: ['#0d6efd', '#6c757d'], // Bleu Bootstrap et gris
                borderWidth: 1
            }]
        },
        options: {
            cutout: '60%',
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

@endsection
