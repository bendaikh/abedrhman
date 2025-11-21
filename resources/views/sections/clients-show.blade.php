@extends('layouts.app')

@section('title', 'Détails du client - Abedrhman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                Détails du client
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Informations complètes du client
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('clients.edit', $client->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Modifier
            </a>
            <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-colors">
                Retour à la liste
            </a>
        </div>
    </div>

    <!-- Client Details Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
        <!-- Basic Info -->
        <div class="border-b border-gray-200 dark:border-gray-700 pb-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        @if($client->type === 'particulier')
                            {{ trim(($client->nom ?? '') . ' ' . ($client->prenom ?? '')) ?: 'N/A' }}
                        @else
                            {{ $client->nom_raison_sociale ?? 'N/A' }}
                        @endif
                    </h3>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 text-sm font-medium rounded-full {{ $client->type === 'societe' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-200' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200' }}">
                            {{ $client->type === 'societe' ? 'Entreprise' : 'Particulier' }}
                        </span>
                        <span class="text-sm text-orange-600 dark:text-orange-400 font-semibold">
                            {{ $client->num_client }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @if($client->type === 'particulier')
            <!-- Particulier Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->nom ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Prénom</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->prenom ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Fonction</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->fonction ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Type pièce ID</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->type_piece_id ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">N° pièce ID</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->n_piece_id ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date de naissance</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->date_naissance ? $client->date_naissance->format('d/m/Y') : 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Lieu de naissance</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->lieu_naissance ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nationalité</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->nationalite ?? 'N/A' }}</p>
                </div>
            </div>
        @else
            <!-- Société Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nom / Raison sociale</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->nom_raison_sociale ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Sigle</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->sigle ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Intitulé</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->intitule ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Forme juridique</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->forme_juridique ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pièce justificative</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->piece_justificative ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">N° pièce</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->numero_piece ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">ICE</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->ice ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">ID fiscale</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->id_fiscale ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Patente</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->patente ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date création</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->date_creation ? $client->date_creation->format('d/m/Y') : 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Forme juridique créée</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->forme_juridique_creee ?? 'N/A' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Siège social</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->siege_social ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Secteur d'activité</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->secteur_activite ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Activité</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->activite ?? 'N/A' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Autre adresse d'activité</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->autre_adresse_activite ?? 'N/A' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Adresse (dépôt ou magasin)</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->adresse_depot_magasin ?? 'N/A' }}</p>
                </div>
            </div>
        @endif

        <!-- Contact Information (Common for both types) -->
        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informations de contact</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Ville</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->ville ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pays</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->pays ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Téléphone 1</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->tel_1 ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Téléphone 2</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->tel_2 ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Fixe</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->fixe ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Observations -->
        @if($client->observations)
        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Observations</h4>
            <p class="text-base text-gray-900 dark:text-white whitespace-pre-wrap">{{ $client->observations }}</p>
        </div>
        @endif

        <!-- Source Information -->
        @if($client->source || $client->intitule_source || $client->intitule_source_data)
        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informations sur la source</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($client->source)
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Source</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->source }}</p>
                </div>
                @endif
                @if($client->intitule_source)
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Intitulé source</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->intitule_source }}</p>
                </div>
                @endif
                @if($client->intitule_source_data)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Détails pour {{ $client->intitule_source ?? 'la source' }}</label>
                    <p class="text-base text-gray-900 dark:text-white">{{ $client->intitule_source_data }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Meta Information -->
        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500 dark:text-gray-400">
                <div>
                    <span class="font-medium">Créé le:</span> {{ $client->created_at->format('d/m/Y à H:i') }}
                </div>
                <div>
                    <span class="font-medium">Modifié le:</span> {{ $client->updated_at->format('d/m/Y à H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between">
        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce client ? Cette action est irréversible.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Supprimer ce client
            </button>
        </form>
    </div>
</div>
@endsection

