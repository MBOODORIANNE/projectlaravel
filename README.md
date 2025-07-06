Akoum - Application Web pour la Gestion de la Disponibilité des Produits Locaux au Cameroun
Description
Akoum est une application web développée avec Laravel, destinée à faciliter la gestion de la disponibilité et la vente des produits fabriqués localement au Cameroun. Elle permet aux producteurs d’enregistrer leurs produits et points de vente, et aux consommateurs de consulter les produits disponibles, rechercher par catégorie ou localisation, et passer des commandes.

Ce projet vise à valoriser les produits locaux, améliorer la visibilité des producteurs et faciliter l’accès des consommateurs aux produits locaux de qualité.

Fonctionnalités
Enregistrement des producteurs et des consommateurs

Gestion des produits : création, mise à jour, suppression

Gestion des points de vente associés aux producteurs

Visualisation des produits disponibles par catégorie

Recherche des producteurs par ville

Interface dédiée pour chaque rôle (producteur, consommateur, administrateur)

Authentification sécurisée avec gestion des rôles

Validation des comptes producteurs et consommateurs par l’administrateur

Notifications (email/SMS) lors de la validation des comptes

Tableau de bord personnalisé selon le rôle utilisateur

Déconnexion sécurisée

Technologies utilisées
Backend : Laravel (PHP Framework)

Frontend : Blade Templates, Bootstrap 5, CSS personnalisé

Base de données : MySQL

Authentification : Laravel Breeze / Sanctum (selon l’implémentation)

Contrôle de version : Git + GitHub

Installation
Prérequis
PHP >= 8.x

Composer

MySQL

Node.js & npm (pour assets front-end)

Étapes
Cloner le dépôt

bash
Copier
Modifier
git clone https://github.com/MBOODORIANNE/projectLaravel.git
cd projectLaravel
Installer les dépendances PHP

bash
Copier
Modifier
composer install
Copier le fichier d’environnement et configurer la base de données

bash
Copier
Modifier
cp .env.example .env
# Modifier .env avec vos identifiants MySQL
Générer la clé d’application

bash
Copier
Modifier
php artisan key:generate
Lancer les migrations et les seeders

bash
Copier
Modifier
php artisan migrate --seed
Installer les dépendances front-end et compiler les assets

bash
Copier
Modifier
npm install
npm run dev
Lancer le serveur de développement

bash
Copier
Modifier
php artisan serve
Utilisation
Accéder à l’application via http://localhost:8000

S’inscrire en tant que producteur ou consommateur

Se connecter et utiliser le tableau de bord adapté à son rôle

Ajouter/modifier des produits et points de vente (producteur)

Consulter la liste des produits disponibles (consommateur)

Rechercher par catégorie ou ville

Administrer les utilisateurs et valider les inscriptions (administrateur)

Structure du projet
app/Models : Modèles Eloquent (Producteur, Consommateur, Produit, PointDeVente, etc.)

resources/views : Vues Blade pour les interfaces utilisateur

routes/web.php : Définition des routes web

database/migrations : Migrations de la base de données

app/Http/Controllers : Contrôleurs pour la logique métier

public/ : Assets publics (CSS, JS, images)

Contribuer
Les contributions sont les bienvenues !
Merci de créer une branche feature, de faire un commit clair et de proposer une pull request.

Auteur
MBO'O ATANGANA Orlys
Email : mbo.ats@gmail.com
GitHub : https://github.com/MBOODORIANNE

Licence
Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.

