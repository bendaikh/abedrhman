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
                            data-nom="{{ $client->type === 'morale' ? $client->nom_raison_sociale : ($client->nom . ' ' . $client->prenom) }}"
                            data-gerant="{{ $client->type === 'morale' ? ($client->dirigeants->first()->nom ?? 'N/A') : 'N/A' }}"
                            data-ville="{{ $client->ville ?? 'N/A' }}"
                            data-type="{{ $client->type }}"
                            {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->type === 'morale' ? $client->nom_raison_sociale : ($client->nom . ' ' . $client->prenom) }}
                            @if($client->num_client) ({{ $client->num_client }}) @endif
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
                            <option value="{{ $type->id }}" {{ old('type_service_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->nom }}
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

// Show client info on page load if already selected
document.addEventListener('DOMContentLoaded', function() {
    const clientId = document.getElementById('client_id').value;
    if (clientId) {
        showClientInfo(clientId);
    }
});
</script>
@endsection
