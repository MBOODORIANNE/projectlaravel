@extends('layouts.app')

@section('content')
<h2>Utilisateurs à valider</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->prenom }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <form action="{{ route('users.validate', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn btn-sm btn-success">Valider</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
