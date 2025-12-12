@extends('layouts.app')

@section('title', 'Tarification - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Tarification</h2>
        <p class="text-blue-100 text-sm sm:text-base">Sélectionnez un type de service pour configurer ses offres et tarifs.</p>
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

    <!-- Type Service Selection -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Sélectionner un type de service
        </h3>
        
        @if($typesServices->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($typesServices as $typeService)
            <button 
                type="button"
                onclick="selectTypeService({{ $typeService->id }}, '{{ $typeService->nom }}')"
                class="type-service-card group p-4 rounded-xl border-2 transition-all duration-200 text-left hover:shadow-lg
                    {{ $loop->first ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : 'border-gray-200 dark:border-gray-700 hover:border-blue-300 dark:hover:border-blue-600 bg-white dark:bg-gray-800' }}"
                data-type-id="{{ $typeService->id }}"
            >
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                        <span class="text-white font-bold text-lg">{{ strtoupper(substr($typeService->nom, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ $typeService->nom }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $typeService->code }}</p>
                    </div>
                </div>
                @if($typeService->description)
                <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">{{ $typeService->description }}</p>
                @endif
                <div class="mt-2 flex items-center gap-2">
                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                        {{ $typeService->offres->count() }} offre(s)
                    </span>
                    @if($typeService->prix)
                    <span class="px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300">
                        {{ $typeService->formatted_prix }}
                    </span>
                    @endif
                </div>
            </button>
            @endforeach
        </div>
        @else
        <div class="text-center py-8">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Aucun type de service</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Commencez par créer des types de services.</p>
            <a href="{{ route('parametres.types-services') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Créer un type de service
            </a>
        </div>
        @endif
    </div>

    <!-- Tarification Content (Dynamic) -->
    <div id="tarification-content" class="{{ $typesServices->count() > 0 ? '' : 'hidden' }}">
        @if($typesServices->count() > 0)
        @php $firstTypeService = $typesServices->first(); @endphp
        
        <!-- Section Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                <span id="selected-type-name">{{ $firstTypeService->nom }}</span>
                <span class="text-sm font-normal text-gray-500">- Configuration des offres et tarifs</span>
            </h3>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Add Offre Form -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Nouvelle offre
                    </h4>
                    <form action="{{ route('parametres.offres.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="type_service_id" id="offre_type_service_id" value="{{ $firstTypeService->id }}">
                        
                        <div>
                            <label for="offre_nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom de l'offre *</label>
                            <input type="text" name="nom" id="offre_nom" required placeholder="Ex: 6 mois, 1 an..." 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        
                        <div>
                            <label for="offre_duree_mois" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Durée (mois)</label>
                            <input type="number" name="duree_mois" id="offre_duree_mois" min="1" placeholder="Ex: 6, 12, 24..." 
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        
                        <div>
                            <label for="offre_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="description" id="offre_description" rows="2" placeholder="Description de l'offre..."
                                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <input type="checkbox" name="is_active" id="offre_is_active" checked 
                                class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="offre_is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Offre active</label>
                        </div>
                        
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Ajouter l'offre
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tarification Grid -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 bg-blue-50 dark:bg-blue-900/20">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Grille tarifaire</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Configurez les prix pour chaque combinaison offre/tarification</p>
                            </div>
                        </div>
                    </div>

                    @if($firstTypeService->offres->count() > 0 && $typesTarification->count() > 0)
                    {{-- Hidden forms for delete actions (must be outside the main form) --}}
                    @foreach($firstTypeService->offres as $offre)
                    <form id="delete-offre-{{ $offre->id }}" action="{{ route('parametres.offres.destroy', $offre) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endforeach

                    <form action="{{ route('parametres.tarifications.update', $firstTypeService) }}" method="POST" id="tarifications-form">
                        @csrf
                        @method('PUT')
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-900/50">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Offre</th>
                                        @foreach($typesTarification as $type)
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">{{ $type->nom }}</th>
                                        @endforeach
                                        <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="offres-tbody">
                                    @foreach($firstTypeService->offres as $offre)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $offre->nom }}</div>
                                            @if($offre->duree_mois)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $offre->duree_mois }} mois</div>
                                            @endif
                                        </td>
                                        @foreach($typesTarification as $type)
                                        @php
                                            $tarif = $offre->tarifications->where('type_tarification_id', $type->id)->first();
                                        @endphp
                                        <td class="px-4 py-3 whitespace-nowrap text-center">
                                            <input type="number" 
                                                name="tarifications[{{ $offre->id }}][{{ $type->id }}]" 
                                                value="{{ $tarif ? $tarif->prix : '' }}" 
                                                min="0" 
                                                step="0.01"
                                                placeholder="—"
                                                class="w-24 px-2 py-1 text-sm text-center rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        </td>
                                        @endforeach
                                        <td class="px-4 py-3 whitespace-nowrap text-center">
                                            <button type="button" 
                                                onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')) { document.getElementById('delete-offre-{{ $offre->id }}').submit(); }"
                                                class="p-1 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors" 
                                                title="Supprimer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Enregistrer les tarifs
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="p-8 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        @if($firstTypeService->offres->count() == 0)
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucune offre</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Commencez par créer des offres pour ce type de service.</p>
                        @else
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucun type de tarification</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Vous devez d'abord créer des types de tarification.</p>
                        <a href="{{ route('parametres.types-tarification') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            Configurer les types de tarification
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Configuration Links Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Configuration additionnelle
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <a href="{{ route('parametres.types-tarification') }}" class="group p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-purple-300 dark:hover:border-purple-600 hover:shadow-md transition-all">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors">
                        <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white">Types de tarification</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $typesTarification->count() }} types</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('parametres.sous-services') }}" class="group p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-indigo-300 dark:hover:border-indigo-600 hover:shadow-md transition-all">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center group-hover:bg-indigo-200 dark:group-hover:bg-indigo-900/50 transition-colors">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white">Sous-services</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sousServices->count() }} sous-services</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('parametres.rubriques') }}" class="group p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-600 hover:shadow-md transition-all">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center group-hover:bg-red-200 dark:group-hover:bg-red-900/50 transition-colors">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 dark:text-white">Rubriques & Types de charge</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Décaissements</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
function selectTypeService(typeId, typeName) {
    // Update visual selection
    document.querySelectorAll('.type-service-card').forEach(card => {
        card.classList.remove('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
        card.classList.add('border-gray-200', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');
    });
    
    const selectedCard = document.querySelector(`[data-type-id="${typeId}"]`);
    if (selectedCard) {
        selectedCard.classList.remove('border-gray-200', 'dark:border-gray-700', 'bg-white', 'dark:bg-gray-800');
        selectedCard.classList.add('border-blue-500', 'bg-blue-50', 'dark:bg-blue-900/20');
    }
    
    // Update form hidden input
    document.getElementById('offre_type_service_id').value = typeId;
    
    // Update header
    document.getElementById('selected-type-name').textContent = typeName;
    
    // Reload page with selected type (for now - could be AJAX later)
    window.location.href = `{{ route('parametres.index') }}?type_service=${typeId}`;
}
</script>
@endsection
