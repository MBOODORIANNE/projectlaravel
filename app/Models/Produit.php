<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\User;  

class Produit extends Model
{
    protected $fillable = [
       
        'libelle', 'description', 'prix', 'stock', 'photo', 'categorie_id', 'user_id','statut'
    ];
     // ✅ Ajout des constantes de statut
    const STATUT_ATTENTE = 'attente';
    const STATUT_VALIDE = 'valide';
    const STATUT_REFUSE = 'refuse';

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

public function user()
{
     return $this->belongsTo(User::class, 'user_id'); // important !
}
}
