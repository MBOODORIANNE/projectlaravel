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

    .dashboard-layout {
        display: flex;
        min-height: 100vh;
        gap: 20px;
        padding: 30px 50px;
        box-sizing: border-box;
    }

    .sidebar {
        width: 250px;
        background-color: #1e88e5;
        color: white;
        padding: 20px;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
    }

    .sidebar h3 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .sidebar a {
        color: #cce6ff;
        padding: 12px 15px;
        margin-bottom: 12px;
        text-decoration: none;
        font-weight: 600;
        border-radius: 8px;
        transition: background-color 0.2s ease;
    }

    .sidebar a:hover {
        background-color: #1565c0;
        color: #fff;
    }

    .main-content {
        flex-grow: 1;
    }

    .dashboard-header {
        text-align: center;
        margin-bottom: 40px;
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
        margin-bottom: 40px;
        transition: box-shadow 0.3s ease;
    }

    .products-list:hover {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .products-list h3 {
        margin-bottom: 25px;
        color: #34495e;
        font-weight: 700;
    }

    .products-list ul {
        list-style: none;
        padding: 0;
    }

    .products-list li {
        padding: 14px 0;
        border-bottom: 1px solid #eee;
        font-size: 1.15rem;
        display: flex;
        justify-content: space-between;
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
        margin-bottom: 40px;
    }

    .card-option {
        border-radius: 20px;
        background-color: white;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        cursor: pointer;
        height: 100%;
    }

    .card-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18);
    }

    .card-option .card-body {
        padding: 30px;
    }

    .card-option .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #222;
    }

    .card-option .card-text {
        margin-bottom: 20px;
        color: #555;
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
        margin-top: 40px;
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

<div class="dashboard-layout">

    {{-- Menu latéral --}}
    <div class="sidebar">
        <h3>👤 Consommateur</h3>
        <a href="{{ route('listing.produits.categories') }}">🔍 Produits par catégorie</a>
        <a href="{{ route('listing.producteurs.ville') }}">🧑‍🌾 Producteurs par ville</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm mt-4" type="submit" style="background-color:#dc3545;color:white;width:100%;border-radius:10px;">🚪 Déconnexion</button>
        </form>
    </div>

    {{-- Zone principale --}}
    <div class="main-content">
        <div class="dashboard-header">
            <h2>🎯 Tableau de bord - Consommateur</h2>
        </div>

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

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card card-option">
                    <div class="card-body">
                        <h5 class="card-title">🔍 Rechercher par catégorie</h5>
                        <p class="card-text">Explorez les produits selon leur type ou catégorie.</p>
                        <a href="{{ route('listing.produits.categories') }}" class="btn btn-primary">Voir les catégories</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-option">
                    <div class="card-body">
                        <h5 class="card-title">🧑‍🌾 Producteurs par ville</h5>
                        <p class="card-text">Consultez les producteurs dans votre localité.</p>
                        <a href="{{ route('listing.producteurs.ville') }}" class="btn btn-success">Voir les villes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
