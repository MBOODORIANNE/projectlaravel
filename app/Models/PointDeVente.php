<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\User;        

class PointDeVente extends Model
{
      protected $table = 'pointvente'; // <-- indique le nom exact de ta table
     protected $fillable = [
        'user_id','nom', 'ville', 'quartier', 'heure_ouverture', 'heure_fermeture', 'statut'
    ];
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}


