@extends('layouts.app')

@section('title', 'Nouveau service - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('services.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Services</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Nouveau service</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-teal-600 to-cyan-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <h2 class="text-xl sm:text-2xl font-bold mb-2">Créer un nouveau service</h2>
        <p class="text-teal-100 text-sm sm:text-base">Sélectionnez un client et remplissez les informations du service</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
        <form action="{{ route('services.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Client Selection Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Sélection du client
                </h3>
                
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Client *</label>
                    <select name="client_id" id="client_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        onchange="showClientInfo(this.value)">
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" 
                            data-nom="{{ $client->type === 'particulier' ? ($client->nom . ' ' . $client->prenom) : $client->nom_raison_sociale }}"
                            data-raison-sociale="{{ $client->type !== 'particulier' ? $client->nom_raison_sociale : '' }}"
                            data-gerant="{{ $client->type !== 'particulier' ? ($client->dirigeants->first()->nom ?? 'N/A') : 'N/A' }}"
                            data-ville="{{ $client->ville ?? 'N/A' }}"
                            data-type="{{ $client->type }}"
                            {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            @if($client->type === 'particulier')
                                {{ $client->nom }} {{ $client->prenom }}
                            @else
                                {{ $client->nom_raison_sociale }}@if($client->sigle) ({{ $client->sigle }})@endif
                            @endif
                            @if($client->num_client) - {{ $client->num_client }}@endif
                        </option>
                        @endforeach
                    </select>
                    @error('client_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Client Info Block -->
                <div id="client-info-block" class="hidden bg-gradient-to-br from-slate-50 to-teal-50 dark:from-gray-700/50 dark:to-teal-900/20 rounded-xl p-4 border border-teal-200 dark:border-teal-800">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-full bg-teal-100 dark:bg-teal-900/50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nom / Raison sociale</p>
                                <p id="client-nom" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">-</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gérant</p>
                                <p id="client-gerant" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">-</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ville</p>
                                <p id="client-ville" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-gray-200 dark:border-gray-700">

            <!-- Service Details Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Détails du service
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Type Service -->
                    <div>
                        <label for="type_service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de service *</label>
                        <select name="type_service_id" id="type_service_id" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                            <option value="">Sélectionner un type</option>
                            @foreach($typesServices as $type)
                            <option value="{{ $type->id }}" 
                                data-prix="{{ $type->prix ?? 0 }}"
                                {{ (old('type_service_id', $selectedTypeServiceId ?? '') == $type->id) ? 'selected' : '' }}>
                                {{ $type->nom }}
                                @if($type->prix) - {{ $type->formatted_prix }}@endif
                            </option>
                            @endforeach
                        </select>
                        @error('type_service_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prix -->
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prix (DH) *</label>
                        <input type="number" name="prix" id="prix" value="{{ old('prix', 0) }}" required min="0" step="0.01"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                            placeholder="0.00">
                        @error('prix')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors resize-none"
                        placeholder="Description du service...">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" checked
                        class="w-4 h-4 text-teal-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-teal-500 focus:ring-2">
                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Service actif</label>
                </div>
            </div>

            <hr class="border-gray-200 dark:border-gray-700">

            <!-- Sous-Services Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Sous-services (optionnel)
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">- Sélectionnez les sous-services à inclure</span>
                </h3>

                @if($sousServices->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach($sousServices as $sousService)
                    <label class="relative flex items-start p-4 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-indigo-300 dark:hover:border-indigo-600 cursor-pointer transition-colors sous-service-item">
                        <input type="checkbox" name="sous_services[]" value="{{ $sousService->id }}"
                            class="w-4 h-4 mt-0.5 text-indigo-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-indigo-500 focus:ring-2"
                            data-prix="{{ $sousService->prix }}"
                            onchange="updateTotalPreview()">
                        <div class="ml-3 flex-1">
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $sousService->nom }}</span>
                            <span class="block text-sm text-indigo-600 dark:text-indigo-400 font-semibold">{{ $sousService->formatted_prix }}</span>
                            @if($sousService->description)
                            <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $sousService->description }}</span>
                            @endif
                        </div>
                    </label>
                    @endforeach
                </div>

                <!-- Total Preview -->
                <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-indigo-800 dark:text-indigo-200">Aperçu du montant total</p>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400">Prix de base + sous-services sélectionnés</p>
                        </div>
                        <div class="text-right">
                            <p id="total-preview" class="text-2xl font-bold text-indigo-700 dark:text-indigo-300">0,00 DH</p>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400">
                                Base: <span id="base-preview">0,00</span> + Sous-services: <span id="sous-services-preview">0,00</span>
                            </p>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Aucun sous-service disponible. Vous pouvez en ajouter depuis les paramètres.</p>
                    <a href="{{ route('parametres.sous-services') }}" class="inline-flex items-center mt-2 text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Créer des sous-services
                    </a>
                </div>
                @endif
            </div>

            <!-- Info Note -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        <strong>Note:</strong> Le service sera créé avec le statut <span class="font-semibold">"Initialisé"</span>. 
                        Vous pourrez ensuite gérer les paiements et modifier le statut depuis la liste des services.
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('services.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Créer le service
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showClientInfo(clientId) {
    const select = document.getElementById('client_id');
    const infoBlock = document.getElementById('client-info-block');
    const selectedOption = select.options[select.selectedIndex];
    
    if (clientId && selectedOption) {
        const nom = selectedOption.dataset.nom || '-';
        const gerant = selectedOption.dataset.gerant || 'N/A';
        const ville = selectedOption.dataset.ville || 'N/A';
        const type = selectedOption.dataset.type;
        
        document.getElementById('client-nom').textContent = nom;
        document.getElementById('client-gerant').textContent = type === 'morale' ? gerant : 'N/A (Particulier)';
        document.getElementById('client-ville').textContent = ville;
        
        infoBlock.classList.remove('hidden');
    } else {
        infoBlock.classList.add('hidden');
    }
}

function updateTotalPreview() {
    const prixInput = document.getElementById('prix');
    const basePrix = parseFloat(prixInput.value) || 0;
    
    let sousServicesTotal = 0;
    document.querySelectorAll('input[name="sous_services[]"]:checked').forEach(checkbox => {
        sousServicesTotal += parseFloat(checkbox.dataset.prix) || 0;
    });
    
    const total = basePrix + sousServicesTotal;
    
    document.getElementById('base-preview').textContent = formatCurrency(basePrix);
    document.getElementById('sous-services-preview').textContent = formatCurrency(sousServicesTotal);
    document.getElementById('total-preview').textContent = formatCurrency(total) + ' DH';
}

function formatCurrency(value) {
    return value.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
}

// Auto-set price from type service selection
document.getElementById('type_service_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const prix = selectedOption.dataset.prix;
    if (prix && parseFloat(prix) > 0) {
        document.getElementById('prix').value = parseFloat(prix).toFixed(2);
        updateTotalPreview();
    }
});

// Update preview on price change
document.getElementById('prix').addEventListener('input', updateTotalPreview);

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    const clientId = document.getElementById('client_id').value;
    if (clientId) {
        showClientInfo(clientId);
    }
    
    // Trigger type service change to set default price
    const typeServiceSelect = document.getElementById('type_service_id');
    if (typeServiceSelect.value) {
        const event = new Event('change');
        typeServiceSelect.dispatchEvent(event);
    }
    
    updateTotalPreview();
});
</script>
@endsection
