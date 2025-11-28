@extends('layouts.app')

@section('title', 'Détails du comptable - Abedrhman')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="{{ route('comptables.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">Détails du comptable</h2>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('comptables.edit', $comptable->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                Modifier
            </a>
            <form action="{{ route('comptables.destroy', $comptable->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Raison sociale</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->raison_sociale ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Activité</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->activite ?? 'N/A' }}</dd>
                </div>
            </dl>

            <!-- Responsable Section -->
            <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Responsable</h3>
                <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</dt>
                        <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->responsable_nom ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Prénom</dt>
                        <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->responsable_prenom ?? 'N/A' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Fonction</dt>
                        <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->fonction ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Téléphone</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->tel ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->email ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">ICE</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->ice ?? 'N/A' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">RIB</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->rib ?? 'N/A' }}</dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Adresse</dt>
                    <dd class="text-base text-gray-900 dark:text-white">{{ $comptable->adresse ?? 'N/A' }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
