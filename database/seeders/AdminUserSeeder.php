<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nom' => 'Admin',
                'prenom' => 'Super',
                'email' => 'admin@example.com',
                'telephone' => '0000000000',
                'ville' => 'VilleAdmin',
                'quartier' => 'Centre',
                'sexe' => 'Homme',
                'nom_utilisateur' => 'admin',
                'password' => Hash::make('admin123'), // Changez le mot de passe si besoin
                'role' => 'administrateur',
                'is_validated' => true,
                // Ajoutez d'autres champs si nécessaires (ex: telephone, ville, etc.)
            ]
        );
    }
}
