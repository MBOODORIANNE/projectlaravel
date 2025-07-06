<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-center mb-4">Créer un compte producteur</h2>

        <div>
            <x-input-label for="role" :value="__('role')" />
            <select id="role" name="role" class="block mt-1 w-full @error('role') border-red-500 @enderror" required>
                <option value="">Sélectionner un rôle</option>
                <option value="producteur" @if(old('role')=='producteur') selected @endif>Producteur</option>
                <option value="consommateur" @if(old('role')=='consommateur') selected @endif>Consommateur</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="nom" :value="__('Nom')" />
            <x-text-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')" required />
            <x-input-error :messages="$errors->get('nom')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="ville" :value="__('Ville')" />
            <x-text-input id="ville" class="block mt-1 w-full" type="text" name="ville" :value="old('ville')" required />
            <x-input-error :messages="$errors->get('ville')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="quartier" :value="__('Quartier')" />
            <x-text-input id="quartier" class="block mt-1 w-full" type="text" name="quartier" :value="old('quartier')" required />
            <x-input-error :messages="$errors->get('quartier')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="sexe" :value="__('Sexe')" />
            <select id="sexe" name="sexe" class="block mt-1 w-full @error('sexe') border-red-500 @enderror" required>
                <option value="">Sélectionner</option>
                <option value="Homme" @if(old('sexe')=='Homme') selected @endif>Homme</option>
                <option value="Femme" @if(old('sexe')=='Femme') selected @endif>Femme</option>
            </select>
            <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="nom_utilisateur" :value="__('Nom utilisateur')" />
            <x-text-input id="nom_utilisateur" class="block mt-1 w-full" type="text" name="nom_utilisateur" :value="old('nom_utilisateur')" required />
            <x-input-error :messages="$errors->get('nom_utilisateur')" class="mt-2" />
        </div>
<div class="mt-4" style="position: relative;">
    <x-input-label for="password" :value="__('Mot de passe')" />
    <x-text-input id="password" class="block mt-1 w-full pr-10"
                  type="password"
                  name="password"
                  required autocomplete="new-password" />
    <span onclick="togglePassword('password')"
          style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
                 cursor: pointer; user-select: none; font-size: 1.2rem;">
        👁️
    </span>
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<div class="mt-4" style="position: relative;">
    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
    <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                  type="password"
                  name="password_confirmation" required autocomplete="new-password" />
    <span onclick="togglePassword('password_confirmation')"
          style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
                 cursor: pointer; user-select: none; font-size: 1.2rem;">
        👁️
    </span>
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        if(input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Déjà inscrit ? Se connecter') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
