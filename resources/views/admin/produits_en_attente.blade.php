<h2>Produits en attente</h2>

<table>
    <thead>
        <tr>
            <th>Libellé</th>
            <th>Producteur</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->libelle }}</td>
                <td>{{ $produit->user->name }}</td>
                <td>{{ $produit->statut }}</td>
                <td>
                    <form action="{{ route('admin.valider', $produit->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Valider</button>
                    </form>

                    <form action="{{ route('admin.refuser', $produit->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Refuser</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if($produits->isEmpty())
    <p>Aucun produit en attente.</p>
@endif