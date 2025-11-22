@extends('layouts.app')

@section('title', 'Détails de l\'actionnaire - Abedrhman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-3 lg:gap-4">
        <div class="w-full lg:w-auto">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">
                Détails de l'actionnaire
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">
                Client: <span class="font-medium">{{ $client->nom_raison_sociale }}</span>
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-2 sm:gap-3 w-full lg:w-auto">
            <a href="{{ route('actionnaires.edit', [$client->id, $actionnaire->id]) }}" class="inline-flex items-center justify-center flex-1 sm:flex-initial px-3 sm:px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Modifier
            </a>
            <a href="{{ route('actionnaires.index', $client->id) }}" class="inline-flex items-center justify-center flex-1 sm:flex-initial px-3 sm:px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-1 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour à la liste
            </a>
        </div>
    </div>

    <!-- Actionnaire Details Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-4 sm:p-6">
        <!-- Basic Info -->
        <div class="border-b border-gray-200 dark:border-gray-700 pb-4 sm:pb-6 mb-4 sm:mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        {{ $actionnaire->intitule }} {{ $actionnaire->nom }} {{ $actionnaire->prenom }}
                    </h3>
                    @if($actionnaire->part_sociale_pct)
                        <div class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-200">
                            Part sociale: {{ $actionnaire->part_sociale_pct }}%
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Intitulé</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->intitule ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->nom ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Prénom</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->prenom ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Part sociale %</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->part_sociale_pct ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pièce ID</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->piece_id ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date de naissance</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->date_naissance ? $actionnaire->date_naissance->format('d/m/Y') : 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Lieu de naissance</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->lieu_naissance ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nationalité</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->nationalite ?? 'N/A' }}</p>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Adresse</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->adresse ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Ville</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->ville ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pays</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->pays ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tél1 résp</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->tel1_resp ?? 'N/A' }}</p>
            </div>

            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tél2 résp</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->tel2_resp ?? 'N/A' }}</p>
            </div>

            <div class="md:col-span-2">
                <label class="block text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email résp</label>
                <p class="text-sm sm:text-base text-gray-900 dark:text-white">{{ $actionnaire->email_resp ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Créé le</label>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $actionnaire->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Modifié le</label>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $actionnaire->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

