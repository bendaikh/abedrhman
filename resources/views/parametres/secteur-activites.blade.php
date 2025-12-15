@extends('layouts.app')

@section('title', 'Secteurs d\'activité - Paramètres - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('parametres.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Paramètres</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Secteurs d'activité</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Secteurs d'activité</h2>
        <p class="text-blue-100 text-sm sm:text-base">Gérez les différents secteurs d'activité qui seront disponibles lors de la création de clients.</p>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm text-emerald-700 dark:text-emerald-300">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Add New Secteur Form -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nouveau secteur d'activité
                </h3>
                <form action="{{ route('parametres.secteur-activites.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom du secteur</label>
                        <input type="text" name="nom" id="nom" required placeholder="Ex: COMMERCE" 
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        @error('nom')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" checked 
                            class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                        <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Secteur actif</label>
                    </div>
                    <button type="submit" 
                        class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajouter le secteur
                    </button>
                </form>
            </div>
        </div>

        <!-- Existing Secteurs List -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 bg-blue-50 dark:bg-blue-900/20">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Secteurs d'activité existants
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $secteurActivites->count() }} secteur(s) configuré(s)</p>
                </div>
                
                @if($secteurActivites->count() > 0)
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($secteurActivites as $secteur)
                    <div class="p-4 sm:p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <form action="{{ route('parametres.secteur-activites.update', $secteur) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-col gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                                    <input type="text" name="nom" value="{{ $secteur->nom }}" required 
                                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" name="is_active" id="is_active_{{ $secteur->id }}" {{ $secteur->is_active ? 'checked' : '' }}
                                            class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                        <label for="is_active_{{ $secteur->id }}" class="text-sm text-gray-700 dark:text-gray-300">Actif</label>
                                        @if(!$secteur->is_active)
                                        <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full">Désactivé</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        Sauvegarder
                                    </button>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('parametres.secteur-activites.destroy', $secteur) }}" method="POST" class="mt-2 flex justify-end" 
                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce secteur d\'activité ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Supprimer
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucun secteur d'activité</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Utilisez le formulaire ci-dessus pour créer votre premier secteur d'activité.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

