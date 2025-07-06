<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 30);
            $table->string('prenom', 30);
            $table->string('email', 50)->unique();
            $table->string('telephone', 15)->unique();
            $table->string('ville');
            $table->string('quartier');
            $table->enum('sexe', ['Homme', 'Femme'])->nullable();
            $table->string('nom_utilisateur')->unique();
            $table->string('password');
            $table->enum('role', ['administrateur', 'producteur', 'consommateur']);
            $table->boolean('etat')->default(true);
            $table->boolean('is_active')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
