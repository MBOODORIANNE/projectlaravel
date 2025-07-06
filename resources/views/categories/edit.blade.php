@extends('layouts.app')

@section('content')
<h2>Modifier une catégorie</h2>
<form method="POST" action="{{ route('categories.update', $categorie->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Libellé</label>
        <input type="text" name="libelle" class="form-control" value="{{ $categorie->libelle }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection
