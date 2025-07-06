<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
     protected $guard_name = 'web'; // or whatever guard you want to use

    protected $fillable = [
        'name',
        'nom',
        'prenom',
        'email',
        'telephone',
        'ville',
        'quartier',
        'sexe',
        'nom_utilisateur',
        'password',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    // Relations
    public function produits()
    {
        // Si utilisateur est producteur, il peut avoir plusieurs produits
        return $this->hasMany(Produit::class , 'user_id');
    }
    public function pointsDeVente()
{
    return $this->hasMany(\App\Models\PointDeVente::class);
}
            
    public function scopeProducteurs($query)
    {
        return $query->where('role', 'producteur');
    }

    public function scopeConsommateurs($query)
    {
        return $query->where('role', 'consommateur');
    }

    public function scopeAdministrateurs($query)
    {
        return $query->where('role', 'administrateur');
    }
}

