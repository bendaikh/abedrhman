@extends('layouts.app')

@section('title', ($client ? 'Modifier' : 'Créer') . ' un client - Abedrhman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                {{ $client ? 'Modifier le client' : 'Créer un client' }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ $client ? 'Modifiez les informations du client' : 'Remplissez les informations pour créer un nouveau client' }}
            </p>
        </div>
        <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-colors">
            Retour à la liste
        </a>
    </div>

    <!-- Form -->
    <form action="{{ $client ? route('clients.update', $client->id) : route('clients.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
        @csrf
        @if($client)
            @method('PUT')
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Num client -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <span class="text-orange-600 dark:text-orange-400 font-semibold">Num client</span>
                </label>
                <input type="text" name="num_client" value="{{ old('num_client', $client->num_client ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Généré automatiquement si vide">
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type *</label>
                <select name="type" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="particulier" {{ old('type', $client->type ?? 'particulier') === 'particulier' ? 'selected' : '' }}>Particulier</option>
                    <option value="Entreprise" {{ old('type', $client->type ?? '') === 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                </select>
            </div>

            <!-- Nom / raison sociale -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom / raison sociale</label>
                <input type="text" name="nom_raison_sociale" value="{{ old('nom_raison_sociale', $client->nom_raison_sociale ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Sigle -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sigle</label>
                <input type="text" name="sigle" value="{{ old('sigle', $client->sigle ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Intitulé -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Intitulé</label>
                <input type="text" name="intitule" value="{{ old('intitule', $client->intitule ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Forme juridique -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Forme juridique</label>
                <input type="text" name="forme_juridique" value="{{ old('forme_juridique', $client->forme_juridique ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Pièce justificative -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pièce justificative</label>
                <input type="text" name="piece_justificative" value="{{ old('piece_justificative', $client->piece_justificative ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- N° pièce -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">N° pièce</label>
                <input type="text" name="numero_piece" value="{{ old('numero_piece', $client->numero_piece ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Date création -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date création</label>
                <input type="date" name="date_creation" value="{{ old('date_creation', ($client && $client->date_creation) ? $client->date_creation->format('Y-m-d') : '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Forme juridique créée -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Forme juridique créée</label>
                <input type="text" name="forme_juridique_creee" value="{{ old('forme_juridique_creee', $client->forme_juridique_creee ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Siège social -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Siège social</label>
                <textarea name="siege_social" rows="3" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('siege_social', $client->siege_social ?? '') }}</textarea>
            </div>

            <!-- Ville -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $client->ville ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Pays -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pays</label>
                <input type="text" name="pays" value="{{ old('pays', $client->pays ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Secteur d'activité -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Secteur d'activité</label>
                <input type="text" name="secteur_activite" value="{{ old('secteur_activite', $client->secteur_activite ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Activité -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Activité</label>
                <input type="text" name="activite" value="{{ old('activite', $client->activite ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Autre adresse d'activité -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Autre adresse d'activité</label>
                <textarea name="autre_adresse_activite" rows="3" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('autre_adresse_activite', $client->autre_adresse_activite ?? '') }}</textarea>
            </div>

            <!-- Adresse (dépôt ou magasin) -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adresse (dépôt ou magasin)</label>
                <textarea name="adresse_depot_magasin" rows="3" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('adresse_depot_magasin', $client->adresse_depot_magasin ?? '') }}</textarea>
            </div>

            <!-- Tél 1 -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél 1</label>
                <input type="text" name="tel_1" value="{{ old('tel_1', $client->tel_1 ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Tél 2 -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél 2</label>
                <input type="text" name="tel_2" value="{{ old('tel_2', $client->tel_2 ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Fixe -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fixe</label>
                <input type="text" name="fixe" value="{{ old('fixe', $client->fixe ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $client->email ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Observations -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Observations</label>
                <textarea name="observations" rows="4" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('observations', $client->observations ?? '') }}</textarea>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-8 flex items-center justify-end space-x-4">
            <a href="{{ route('clients.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                {{ $client ? 'Modifier' : 'Créer' }} le client
            </button>
        </div>
    </form>
</div>
@endsection

