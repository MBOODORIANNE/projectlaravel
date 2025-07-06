@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        background: linear-gradient(135deg, #f0f4ff 0%, #d6e4ff 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #2c3e50;
    }

    .dashboard-container {
        width: 100%;
        min-height: 100vh;
        padding: 40px 60px;
        box-sizing: border-box;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .dashboard-header h2 {
        font-weight: 800;
        color: #1a1a1a;
        font-size: 2.5rem;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
    }

    .products-list {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        padding: 30px 40px;
        margin-bottom: 60px;
        transition: box-shadow 0.3s ease;
    }

    .products-list:hover {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .products-list h3 {
        margin-bottom: 25px;
        color: #34495e;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .products-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .products-list li {
        padding: 14px 0;
        border-bottom: 1px solid #eee;
        font-size: 1.15rem;
        color: #2c3e50;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 600;
    }

    .products-list li:last-child {
        border-bottom: none;
    }

    .price {
        color: #2ecc71;
        font-weight: 900;
        font-size: 1.1rem;
    }

    .row.g-4 {
        margin-bottom: 60px;
    }

    .card-option {
        border-radius: 20px;
        background-color: white;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
    }

    .card-option .card-body {
        padding: 35px 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card-option .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #222;
    }

    .card-option .card-text {
        color: #555;
        margin-bottom: 25px;
        font-size: 1rem;
    }

    .card-option .btn {
        margin-top: auto;
        padding: 12px 28px;
        font-weight: 700;
        border-radius: 12px;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #1e88e5;
        border-color: #1e88e5;
    }

    .btn-primary:hover {
        background-color: #1565c0;
        border-color: #1565c0;
    }

    .btn-success {
        background-color: #43a047;
        border-color: #43a047;
    }

    .btn-success:hover {
        background-color: #2e7d32;
        border-color: #2e7d32;
    }

    .logout-section {
        text-align: center;
        margin-top: 60px;
    }

    .logout-section form button {
        padding: 14px 36px;
        border-radius: 14px;
        font-size: 1.15rem;
        font-weight: 700;
        border: 2px solid #dc3545;
        color: #dc3545;
        background-color: transparent;
        transition: all 0.3s ease;
    }

    .logout-section form button:hover {
        background-color: #dc3545;
        color: white;
    }
</style>

<div class="dashboard-container">

    {{-- En-tête --}}
    <div class="dashboard-header">
        <h2>🎯 Tableau de bord - Consommateur</h2>
    </div>

    {{-- Liste des produits disponibles --}}
    <div class="products-list">
        <h3>🛒 Produits disponibles</h3>

        @if(isset($produits) && $produits->isNotEmpty())
            <ul>
                @foreach($produits as $produit)
                    <li>
                        <span>{{ $produit->libelle }}</span>
                        <span class="price">{{ number_format($produit->prix, 0) }} FCFA</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucun produit actuellement disponible.</p>
        @endif
    </div>

    {{-- Options rapides --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card card-option">
                <div class="card-body">
                    <h5 class="card-title">🔍 Rechercher des produits par catégorie</h5>
                    <p class="card-text">Explorez les produits selon leur type ou catégorie spécifique.</p>
                    <a href="{{ route('listing.produits.categories') }}" class="btn btn-primary">Voir les catégories</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-option">
                <div class="card-body">
                    <h5 class="card-title">🧑‍🌾 Trouver des producteurs par ville</h5>
                    <p class="card-text">Consultez les producteurs disponibles dans votre localité.</p>
                    <a href="{{ route('listing.producteurs.ville') }}" class="btn btn-success">Voir les villes</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Déconnexion --}}
    <div class="logout-section">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                🚪 Se déconnecter
            </button>
        </form>
    </div>
</div>
@endsection
