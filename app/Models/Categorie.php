<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['libelle'];
    protected $table = 'categories';

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
