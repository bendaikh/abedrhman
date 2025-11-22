@extends('layouts.app')

@section('title', (isset($actionnaire) ? 'Modifier' : 'Créer') . ' un actionnaire - Abedrhman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4">
        <div class="w-full sm:w-auto">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">
                {{ isset($actionnaire) ? 'Modifier l\'actionnaire' : 'Ajouter un actionnaire' }}
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">
                Client: <span class="font-medium">{{ $client->nom_raison_sociale }}</span>
            </p>
        </div>
        <a href="{{ route('actionnaires.index', $client->id) }}" class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la liste
        </a>
    </div>

    <!-- Form -->
    <form action="{{ isset($actionnaire) ? route('actionnaires.update', [$client->id, $actionnaire->id]) : route('actionnaires.store', $client->id) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-4 sm:p-6">
        @csrf
        @if(isset($actionnaire))
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <!-- Intitulé -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Intitulé</label>
                <select name="intitule" class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Sélectionner</option>
                    <option value="Mr" {{ old('intitule', $actionnaire->intitule ?? '') === 'Mr' ? 'selected' : '' }}>Mr</option>
                    <option value="Mme" {{ old('intitule', $actionnaire->intitule ?? '') === 'Mme' ? 'selected' : '' }}>Mme</option>
                    <option value="Mlle" {{ old('intitule', $actionnaire->intitule ?? '') === 'Mlle' ? 'selected' : '' }}>Mlle</option>
                </select>
            </div>

            <!-- Nom -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom</label>
                <input type="text" name="nom" value="{{ old('nom', $actionnaire->nom ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Prénom -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom', $actionnaire->prenom ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Part sociale % -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Part sociale %</label>
                <input type="number" step="0.01" min="0" max="100" name="part_sociale_pct" value="{{ old('part_sociale_pct', $actionnaire->part_sociale_pct ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    placeholder="20">
            </div>

            <!-- Pièce ID -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pièce ID</label>
                <input type="text" name="piece_id" value="{{ old('piece_id', $actionnaire->piece_id ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Date de naissance -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', isset($actionnaire->date_naissance) ? $actionnaire->date_naissance->format('Y-m-d') : '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Lieu de naissance -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lieu de naissance</label>
                <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $actionnaire->lieu_naissance ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Nationalité -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nationalité</label>
                <input type="text" name="nationalite" value="{{ old('nationalite', $actionnaire->nationalite ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Adresse -->
            <div class="md:col-span-2">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adresse</label>
                <textarea name="adresse" rows="2" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">{{ old('adresse', $actionnaire->adresse ?? '') }}</textarea>
            </div>

            <!-- Ville -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $actionnaire->ville ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Pays -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pays</label>
                <input type="text" name="pays" value="{{ old('pays', $actionnaire->pays ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Tél1 résp -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél1 résp</label>
                <input type="tel" name="tel1_resp" value="{{ old('tel1_resp', $actionnaire->tel1_resp ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Tél2 résp -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél2 résp</label>
                <input type="tel" name="tel2_resp" value="{{ old('tel2_resp', $actionnaire->tel2_resp ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>

            <!-- Email résp -->
            <div class="md:col-span-2">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email résp</label>
                <input type="email" name="email_resp" value="{{ old('email_resp', $actionnaire->email_resp ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 sm:gap-4">
            <a href="{{ route('actionnaires.index', $client->id) }}" class="px-4 sm:px-6 py-2 text-sm sm:text-base text-center border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors order-2 sm:order-1">
                Annuler
            </a>
            <button type="submit" class="px-4 sm:px-6 py-2 text-sm sm:text-base bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors order-1 sm:order-2">
                {{ isset($actionnaire) ? 'Modifier' : 'Ajouter' }} l'actionnaire
            </button>
        </div>
    </form>
</div>
@endsection

