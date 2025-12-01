@extends('layouts.app')

@section('title', 'Modifier le service - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('services.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Services</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Modifier le service</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-teal-600 to-cyan-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Modifier le service</h2>
                <p class="text-teal-100 text-sm sm:text-base">
                    {{ $service->typeService->nom ?? 'N/A' }} - 
                    {{ $service->client ? ($service->client->type === 'morale' ? $service->client->nom_raison_sociale : ($service->client->nom . ' ' . $service->client->prenom)) : 'N/A' }}
                </p>
            </div>
            <a href="{{ route('services.payments', $service) }}" 
                class="inline-flex items-center justify-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Gérer les paiements
            </a>
        </div>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
        <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Client Selection Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Client
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
                            {{ old('client_id', $service->client_id) == $client->id ? 'selected' : '' }}>
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
                <div id="client-info-block" class="{{ $service->client_id ? '' : 'hidden' }} bg-gradient-to-br from-slate-50 to-teal-50 dark:from-gray-700/50 dark:to-teal-900/20 rounded-xl p-4 border border-teal-200 dark:border-teal-800">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-full bg-teal-100 dark:bg-teal-900/50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nom / Raison sociale</p>
                                <p id="client-nom" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">
                                    {{ $service->client ? ($service->client->type === 'morale' ? $service->client->nom_raison_sociale : ($service->client->nom . ' ' . $service->client->prenom)) : '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gérant</p>
                                <p id="client-gerant" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">
                                    {{ $service->client && $service->client->type === 'morale' ? ($service->client->dirigeants->first()->nom ?? 'N/A') : 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ville</p>
                                <p id="client-ville" class="text-sm font-semibold text-gray-900 dark:text-white mt-1">
                                    {{ $service->client ? ($service->client->ville ?? 'N/A') : 'N/A' }}
                                </p>
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

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Type Service -->
                    <div>
                        <label for="type_service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de service *</label>
                        <select name="type_service_id" id="type_service_id" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                            <option value="">Sélectionner un type</option>
                            @foreach($typesServices as $type)
                            <option value="{{ $type->id }}" {{ old('type_service_id', $service->type_service_id) == $type->id ? 'selected' : '' }}>
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
                        <input type="number" name="prix" id="prix" value="{{ old('prix', $service->prix) }}" required min="0" step="0.01"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                            placeholder="0.00">
                        @error('prix')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Statut *</label>
                        <select name="status" id="status" required
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                            <option value="initialiser" {{ old('status', $service->status) == 'initialiser' ? 'selected' : '' }}>Initialisé</option>
                            <option value="en_cours" {{ old('status', $service->status) == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="termine" {{ old('status', $service->status) == 'termine' ? 'selected' : '' }}>Terminé</option>
                            <option value="annule" {{ old('status', $service->status) == 'annule' ? 'selected' : '' }}>Annulé</option>
                        </select>
                        @error('status')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors resize-none"
                        placeholder="Description du service...">{{ old('description', $service->description) }}</textarea>
                    @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" {{ $service->is_active ? 'checked' : '' }}
                        class="w-4 h-4 text-teal-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-teal-500 focus:ring-2">
                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Service actif</label>
                </div>
            </div>

            <!-- Payment Summary -->
            @if($service->payments && $service->payments->count() > 0)
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl p-4 border border-emerald-200 dark:border-emerald-800">
                <h4 class="text-sm font-semibold text-emerald-800 dark:text-emerald-300 mb-3 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Résumé des paiements
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600 dark:text-gray-400">Total payé:</span>
                        <span class="font-semibold text-emerald-600 dark:text-emerald-400 ml-2">{{ $service->formatted_total_payments }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-400">Reste à payer:</span>
                        <span class="font-semibold {{ $service->remaining_amount > 0 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }} ml-2">
                            {{ $service->formatted_remaining_amount }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-600 dark:text-gray-400">Progression:</span>
                        <span class="font-semibold text-gray-900 dark:text-white ml-2">{{ $service->payment_progress }}%</span>
                    </div>
                    <div>
                        <a href="{{ route('services.payments', $service) }}" class="text-teal-600 hover:text-teal-700 dark:text-teal-400 dark:hover:text-teal-300 font-medium">
                            Voir les détails →
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Actions -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('services.index') }}" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Mettre à jour
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
</script>
@endsection
