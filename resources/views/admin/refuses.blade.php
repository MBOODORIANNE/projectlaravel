<h2>Produits refusés</h2>

<table>
    <thead>
        <tr>
            <th>Libellé</th>
            <th>Producteur</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->libelle }}</td>
                <td>{{ $produit->user->name ?? 'Inconnu' }}</td>
                <td>{{ $produit->statut }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@if($produits->isEmpty())
    <p>Aucun produit refusé.</p>
@endif
