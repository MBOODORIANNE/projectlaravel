@extends('layouts.app')

@section('content')
<h2>Liste des utilisateurs</h2>
<a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Ajouter un utilisateur</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Ville</th>
            <th>Quartier</th>
            <th>Sexe</th>
            <th>Nom utilisateur</th>
            <th>Rôle</th>
            <th>Validé</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->prenom }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->telephone }}</td>
            <td>{{ $user->ville }}</td>
            <td>{{ $user->quartier }}</td>
            <td>{{ $user->sexe }}</td>
            <td>{{ $user->nom_utilisateur }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->is_validated ? 'Oui' : 'Non' }}</td>
            <td>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</button>
                </form>
                @if(!$user->is_validated && $user->role === 'producteur')
                    <form action="{{ route('users.validate', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-sm btn-success">Valider</button>
                    </form>
                @endif
            </td>
            <td>
    @if($user->is_validated)
        <span class="text-success">Validé</span>
    @else
        <span class="text-danger">En attente</span>
    @endif
</td>
@if(!$user->is_validated)
    <form action="{{ route('users.validate', $user->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-sm btn-success">Valider</button>
    </form>
@endif
            </td>   
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
