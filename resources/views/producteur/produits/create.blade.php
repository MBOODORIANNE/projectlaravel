@extends('layouts.app')

@section('content')
<h1>Ajouter un produit</h1>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('producteur.produits.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Libellé :</label><br>
    <input type="text" name="libelle" value="{{ old('libelle') }}" required><br><br>

    <label>Description :</label><br>
    <textarea name="description">{{ old('description') }}</textarea><br><br>

    <label>Prix :</label><br>
    <input type="number" step="0.01" name="prix" value="{{ old('prix') }}" required><br><br>

    <label>Stock :</label><br>
    <input type="number" name="stock" min="0" step="1" value="{{ old('stock') }}" required><br><br>

    <label>Photo :</label><br>
    <input type="file" name="photo"><br><br>

    <label>Catégorie :</label><br>
    <select name="categorie_id" required>
        <option value="">-- Choisir une catégorie --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ old('categorie_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->libelle }}
            </option>
        @endforeach
    </select><br><br>

    <button type="submit">Enregistrer</button>
</form>
@endsection
