@extends('layouts.app')

@section('title', 'Sous-services - ' . ($service->client ? ($service->client->type === 'morale' ? $service->client->nom_raison_sociale : $service->client->nom) : 'Service') . ' - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm flex-wrap">
        <a href="{{ route('services.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Services</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Sous-services</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-violet-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Gestion des sous-services</h2>
                <p class="text-indigo-100 text-sm sm:text-base">
                    Sélectionnez les sous-services à affecter à ce service. Le montant total sera automatiquement calculé.
                </p>
            </div>
            <a href="{{ route('services.index') }}" 
                class="inline-flex items-center justify-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour aux services
            </a>
        </div>
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
        <!-- Service Info -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6 space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informations du service
                </h3>
                
                <div class="space-y-3">
                    <!-- Client -->
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Client</label>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
                            @if($service->client)
                                {{ $service->client->type === 'morale' ? $service->client->nom_raison_sociale : ($service->client->nom . ' ' . $service->client->prenom) }}
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    
                    <!-- Type -->
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type de service</label>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
                            {{ $service->typeService->nom ?? 'N/A' }}
                        </p>
                    </div>
                    
                    <!-- Prix de base -->
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Prix de base</label>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
                            {{ $service->formatted_prix }}
                        </p>
                    </div>
                    
                    <!-- Total sous-services -->
                    <div>
                        <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total sous-services</label>
                        <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mt-1">
                            + {{ number_format($service->total_sous_services, 2, ',', ' ') }} DH
                        </p>
                    </div>
                    
                    <hr class="border-gray-200 dark:border-gray-700">
                    
                    <!-- Montant Total -->
                    <div class="bg-indigo-50 dark:bg-indigo-900/30 rounded-lg p-4">
                        <label class="block text-xs font-medium text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Montant Total</label>
                        <p class="text-2xl font-bold text-indigo-700 dark:text-indigo-300 mt-1">
                            {{ $service->formatted_montant_total }}
                        </p>
                    </div>
                </div>
                
                <!-- Currently Assigned Sous-Services -->
                @if($service->sousServices->count() > 0)
                <div class="mt-4">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Sous-services affectés</label>
                    <div class="space-y-2">
                        @foreach($service->sousServices as $ss)
                        <div class="flex items-center justify-between p-2 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <span class="text-sm text-gray-900 dark:text-white">{{ $ss->nom }}</span>
                            <span class="text-sm font-medium text-indigo-600 dark:text-indigo-400">{{ $ss->formatted_prix }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Sous-Services Selection -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 bg-indigo-50 dark:bg-indigo-900/20">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Sélectionner les sous-services
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Cochez les sous-services que vous souhaitez affecter à ce service</p>
                </div>

                @if($allSousServices->count() > 0)
                <form action="{{ route('services.sous-services.sync', $service) }}" method="POST">
                    @csrf
                    <div class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach($allSousServices as $sousService)
                        <label class="flex items-center p-4 sm:p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer">
                            <input type="checkbox" 
                                   name="sous_services[]" 
                                   value="{{ $sousService->id }}"
                                   {{ $service->sousServices->contains($sousService->id) ? 'checked' : '' }}
                                   class="w-5 h-5 text-indigo-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500 focus:ring-2">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $sousService->nom }}</p>
                                        @if($sousService->description)
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $sousService->description }}</p>
                                        @endif
                                    </div>
                                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                        {{ $sousService->formatted_prix }}
                                    </span>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    
                    <div class="p-4 sm:p-6 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <span class="font-medium text-gray-900 dark:text-white">{{ $service->sousServices->count() }}</span> sous-service(s) actuellement sélectionné(s)
                            </div>
                            <button type="submit" 
                                class="inline-flex items-center justify-center px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <div class="p-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucun sous-service disponible</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Vous devez d'abord créer des sous-services dans les paramètres.</p>
                    <a href="{{ route('parametres.sous-services') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Créer des sous-services
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

