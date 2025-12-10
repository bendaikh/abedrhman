@extends('layouts.app')

@section('title', 'Rubriques & Types de charge - Paramètres - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('parametres.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Paramètres</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Rubriques & Types de charge</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Rubriques & Types de charge</h2>
        <p class="text-blue-100 text-sm sm:text-base">Gérez les rubriques et leurs types de charges. Vous pouvez créer des types de charge sans rubrique et les affecter plus tard.</p>
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

    <!-- Tab Navigation -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="flex -mb-px" aria-label="Tabs">
                <button type="button" onclick="switchTab('rubriques')" id="tab-rubriques"
                    class="tab-btn w-1/2 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors
                    border-blue-500 text-blue-600 dark:text-blue-400 bg-blue-50/50 dark:bg-blue-900/20">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Rubriques</span>
                        <span class="bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $rubriques->count() }}</span>
                    </div>
                </button>
                <button type="button" onclick="switchTab('types-charge')" id="tab-types-charge"
                    class="tab-btn w-1/2 py-4 px-6 text-center border-b-2 font-medium text-sm transition-colors
                    border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        <span>Types de charge</span>
                        <span class="bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 text-xs font-semibold px-2 py-0.5 rounded-full">{{ $typesCharge->count() }}</span>
                    </div>
                </button>
            </nav>
        </div>

        <!-- Rubriques Tab Content -->
        <div id="content-rubriques" class="tab-content">
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Add New Rubrique Form -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Nouvelle rubrique
                            </h3>
                            <form action="{{ route('parametres.rubriques.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom de la rubrique *</label>
                                    <input type="text" name="nom" id="nom" required placeholder="Ex: Charges administratives" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    @error('nom')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (optionnel)</label>
                                    <textarea name="description" id="description" rows="3" placeholder="Description de la rubrique..."
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"></textarea>
                                    @error('description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="is_active" id="is_active" checked 
                                        class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Rubrique active</label>
                                </div>
                                <button type="submit" 
                                    class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Ajouter la rubrique
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Existing Rubriques List -->
                    <div class="lg:col-span-2">
                        @if($rubriques->count() > 0)
                        <div class="space-y-4">
                            @foreach($rubriques as $rubrique)
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 sm:p-6">
                                <form action="{{ route('parametres.rubriques.update', $rubrique) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-col gap-4">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                                            <input type="text" name="nom" value="{{ $rubrique->nom }}" required 
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Description</label>
                                            <textarea name="description" rows="2"
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none">{{ $rubrique->description }}</textarea>
                                        </div>
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <input type="checkbox" name="is_active" id="is_active_{{ $rubrique->id }}" {{ $rubrique->is_active ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                                                <label for="is_active_{{ $rubrique->id }}" class="text-sm text-gray-700 dark:text-gray-300">Actif</label>
                                                @if(!$rubrique->is_active)
                                                <span class="px-2 py-0.5 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full">Désactivé</span>
                                                @endif
                                                <span class="px-2 py-0.5 text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full">
                                                    {{ $rubrique->typeCharges->count() }} type(s) de charge
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                                    Sauvegarder
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{ route('parametres.rubriques.destroy', $rubrique) }}" method="POST" class="mt-2 flex justify-end" 
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette rubrique ?');">
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
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-8 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucune rubrique</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Utilisez le formulaire pour créer votre première rubrique.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Types de charge Tab Content -->
        <div id="content-types-charge" class="tab-content hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Add New Type Charge Form -->
                    <div class="lg:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Nouveau type de charge
                            </h3>
                            <form action="{{ route('parametres.types-charge.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="nom_charge" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom du type de charge *</label>
                                    <input type="text" name="nom" id="nom_charge" required placeholder="Ex: Loyer" 
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                    @error('nom')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="rubrique_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rubrique (optionnel)</label>
                                    <select name="rubrique_id" id="rubrique_id"
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                        <option value="">-- Sans rubrique --</option>
                                        @foreach($rubriques as $rubrique)
                                        <option value="{{ $rubrique->id }}">{{ $rubrique->nom }}</option>
                                        @endforeach
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Vous pouvez affecter une rubrique plus tard.</p>
                                    @error('rubrique_id')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="description_charge" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description (optionnel)</label>
                                    <textarea name="description" id="description_charge" rows="3" placeholder="Description du type de charge..."
                                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors resize-none"></textarea>
                                    @error('description')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex items-center gap-2">
                                    <input type="checkbox" name="is_active" id="is_active_charge" checked 
                                        class="w-4 h-4 text-purple-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-purple-500 focus:ring-2">
                                    <label for="is_active_charge" class="text-sm font-medium text-gray-700 dark:text-gray-300">Type de charge actif</label>
                                </div>
                                <button type="submit" 
                                    class="w-full px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Ajouter le type de charge
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Existing Types Charge List -->
                    <div class="lg:col-span-2">
                        @if($typesCharge->count() > 0)
                        <div class="space-y-4">
                            @foreach($typesCharge as $typeCharge)
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 sm:p-6 {{ !$typeCharge->rubrique_id ? 'border-l-4 border-amber-400' : '' }}">
                                <form action="{{ route('parametres.types-charge.update', $typeCharge) }}" method="POST" class="space-y-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex flex-col gap-4">
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                                                <input type="text" name="nom" value="{{ $typeCharge->nom }}" required 
                                                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Rubrique</label>
                                                <select name="rubrique_id"
                                                    class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                                    <option value="">-- Sans rubrique --</option>
                                                    @foreach($rubriques as $rubrique)
                                                    <option value="{{ $rubrique->id }}" {{ $typeCharge->rubrique_id == $rubrique->id ? 'selected' : '' }}>{{ $rubrique->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Description</label>
                                            <textarea name="description" rows="2"
                                                class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors resize-none">{{ $typeCharge->description }}</textarea>
                                        </div>
                                        <div class="flex items-center justify-between flex-wrap gap-2">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <input type="checkbox" name="is_active" id="is_active_charge_{{ $typeCharge->id }}" {{ $typeCharge->is_active ? 'checked' : '' }}
                                                    class="w-4 h-4 text-purple-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-purple-500 focus:ring-2">
                                                <label for="is_active_charge_{{ $typeCharge->id }}" class="text-sm text-gray-700 dark:text-gray-300">Actif</label>
                                                @if(!$typeCharge->is_active)
                                                <span class="px-2 py-0.5 text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full">Désactivé</span>
                                                @endif
                                                @if($typeCharge->rubrique)
                                                <span class="px-2 py-0.5 text-xs font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full">
                                                    {{ $typeCharge->rubrique->nom }}
                                                </span>
                                                @else
                                                <span class="px-2 py-0.5 text-xs font-semibold bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full">
                                                    Sans rubrique
                                                </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg transition-colors">
                                                Sauvegarder
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mt-2 flex justify-end">
                                    <form action="{{ route('parametres.types-charge.destroy', $typeCharge) }}" method="POST" class="inline" 
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce type de charge ?');">
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
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-8 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucun type de charge</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Utilisez le formulaire pour créer votre premier type de charge.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tab) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Reset all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-blue-500', 'border-purple-500', 'text-blue-600', 'text-purple-600', 'dark:text-blue-400', 'dark:text-purple-400', 'bg-blue-50/50', 'bg-purple-50/50', 'dark:bg-blue-900/20', 'dark:bg-purple-900/20');
        btn.classList.add('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:text-gray-700', 'dark:hover:text-gray-300', 'hover:border-gray-300');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Activate selected tab button
    const activeBtn = document.getElementById('tab-' + tab);
    activeBtn.classList.remove('border-transparent', 'text-gray-500', 'dark:text-gray-400', 'hover:text-gray-700', 'dark:hover:text-gray-300', 'hover:border-gray-300');
    
    if (tab === 'rubriques') {
        activeBtn.classList.add('border-blue-500', 'text-blue-600', 'dark:text-blue-400', 'bg-blue-50/50', 'dark:bg-blue-900/20');
    } else {
        activeBtn.classList.add('border-purple-500', 'text-purple-600', 'dark:text-purple-400', 'bg-purple-50/50', 'dark:bg-purple-900/20');
    }
}

// Check URL hash on page load
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#types-charge') {
        switchTab('types-charge');
    }
});
</script>
@endsection
