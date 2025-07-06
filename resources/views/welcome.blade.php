<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AKOM – Produits Locaux</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet" />
 <style>
  body, html {
    height: 100%;
    font-family: 'Quicksand', sans-serif;
    background: url('/images/rice_fields.jpg') no-repeat center center fixed;
    background-size: cover;
    color: white;
  }

  body::before {
    content: "";
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    z-index: 0;
  }

  .content-wrapper {
    position: relative;
    z-index: 1;
    animation: floatLoop 4s ease-in-out infinite;
    text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.8);
  }

  h1 span.brand {
    color: #81c784;
    font-weight: 700;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
  }

  .btn-login {
    background-color: #388e3c;
    border: none;
  }

  .btn-login:hover {
    background-color: #2e7d32;
  }

  .btn-register {
    border: 2px solid white;
    color: white;
  }

  .btn-register:hover {
    background-color: white;
    color: #388e3c;
  }

  .product-card {
    background-color: rgba(255,255,255,0.9);
    color: #222;
    padding: 1rem;
    border-radius: 10px;
    animation: floatLoop 6s ease-in-out infinite;
  }

  .product-card img {
    object-fit: cover;
    height: 180px;
    width: 100%;
    border-radius: 10px;
    transition: transform 0.4s ease;
  }

  footer {
    background-color: #1b5e20;
    padding: 1rem 0;
    text-align: center;
    color: #eee;
    margin-top: 4rem;
  }

  /* Animation de flottement permanent */
  @keyframes floatLoop {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
  }

  .fade-in {
    opacity: 0;
    transform: translateY(40px);
    transition: all 1s ease;
  }

  .fade-in.visible {
    opacity: 1;
    transform: translateY(0);
  }
</style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">🌿 AKOM</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('produits.index') }}">Produits</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">À propos</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="d-flex flex-column justify-content-center align-items-center text-center" style="height:100vh;">
    <div class="content-wrapper px-3">
      <h1 class="display-3 mb-3">Bienvenue sur <span class="brand">AKOM</span></h1>
      <p class="lead mb-4">🥭 Découvrez et soutenez les producteurs locaux en accédant à une large gamme de produits frais et authentiques près de chez vous. 🍍</p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('login') }}" class="btn btn-login btn-lg px-4">Se connecter</a>
        <a href="{{ route('register') }}" class="btn btn-register btn-lg px-4">Créer un compte</a>
      </div>
    </div>
  </section>

  <!-- Produits Vedettes -->
  <section class="container my-5">
    <h2 class="text-center mb-4 text-white">Produits Vedettes</h2>
    <div class="row g-4">
      <div class="col-md-4 fade-in">
        <div class="product-card text-center">
          <img src="/images/rice.jpg" alt="Mangue fraîche" />
          <h5 class="mt-3">Mangue fraîche</h5>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="product-card text-center">
          <img src="/images/rice.jpg" alt="Riz local" />
          <h5 class="mt-3">Riz local</h5>
        </div>
      </div>
      <div class="col-md-4 fade-in">
        <div class="product-card text-center">
          <img src="/images/vendeuse_fruits.jpg" alt="Gingembre" />
          <h5 class="mt-3">Gingembre</h5>
        </div>
      </div>
    </div>
  </section>

  <!-- Aperçu Produits Artisanaux -->
  <section class="container my-5">
    <h2 class="text-center mb-4 text-white">Nos produits artisanaux, agricoles et alimentaires</h2>
    <p class="text-center mb-5" style="max-width: 700px; margin: 0 auto; color: #f0f0f0;">
      Découvrez la richesse et la diversité des produits locaux : des articles artisanaux faits main, des produits agricoles frais, et une variété d’aliments authentiques qui reflètent notre savoir-faire traditionnel.
    </p>
    <div class="row g-4">
      <div class="col-md-4 fade-in text-center">
        <div class="product-card">
          <img src="/images/cereal.jpg" alt="Produits artisanaux" />
          <h5 class="mt-3">Produits artisanaux</h5>
          <p>Objets faits main, sculpture, tissage, poterie, et bien plus encore.</p>
        </div>
      </div>
      <div class="col-md-4 fade-in text-center">
        <div class="product-card">
          <img src="/images/rice.jpg" alt="Produits agricoles" />
          <h5 class="mt-3">Produits agricoles</h5>
          <p>Fruits, légumes, céréales, épices fraîches et cultivées localement.</p>
        </div>
      </div>
      <div class="col-md-4 fade-in text-center">
        <div class="product-card">
          <img src="/images/tomate.jpg" alt="Produits alimentaires" />
          <h5 class="mt-3">Produits alimentaires</h5>
          <p>Plats traditionnels, spécialités locales, douceurs et condiments.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <div class="container">
      <p>© 2025 AKOM – Tous droits réservés | 📍 Cameroun | ✉️ contact@akom.cm</p>
    </div>
  </footer>

  <!-- JS Bootstrap + Fade-In Observer -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const fadeElements = document.querySelectorAll('.fade-in');

    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, { threshold: 0.2 });

    fadeElements.forEach(el => observer.observe(el));
  </script>
</body>
</html>
