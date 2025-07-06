@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Liste des producteurs</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Validé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($producteurs as $producteur)
                    <tr>
                        <td>{{ $producteur->name }}</td>
                        <td>{{ $producteur->email }}</td>
                        <td>{{ $producteur->is_validated ? 'Oui' : 'Non' }}</td>
                        <td>
                            @if(!$producteur->is_validated)
                                <form action="{{ route('admin.producteurs.valider', $producteur->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Valider</button>
                                </form>
                            @else
                                Validé
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
