@extends('layouts.app')

@section('content')
<h2>Ajouter une catégorie</h2>
<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <div class="mb-3">
        <label>Libellé</label>
        <input type="text" name="libelle" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection
