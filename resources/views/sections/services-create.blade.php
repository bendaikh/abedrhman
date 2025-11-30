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
        <p class="text-teal-100 text-sm sm:text-base">Remplissez les informations pour créer un nouveau service</p>
    </div>

    <!-- Form -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
        <form action="{{ route('services.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom du service *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                        placeholder="Ex: Domiciliation annuelle">
                    @error('nom')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

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

                <!-- Durée -->
                <div>
                    <label for="duree" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Durée</label>
                    <div class="flex gap-2">
                        <input type="number" name="duree" id="duree" value="{{ old('duree') }}" min="1"
                            class="flex-1 px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors"
                            placeholder="Ex: 12">
                        <select name="unite_duree" id="unite_duree"
                            class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition-colors">
                            <option value="heure" {{ old('unite_duree') == 'heure' ? 'selected' : '' }}>Heure(s)</option>
                            <option value="jour" {{ old('unite_duree') == 'jour' ? 'selected' : '' }}>Jour(s)</option>
                            <option value="semaine" {{ old('unite_duree') == 'semaine' ? 'selected' : '' }}>Semaine(s)</option>
                            <option value="mois" {{ old('unite_duree', 'mois') == 'mois' ? 'selected' : '' }}>Mois</option>
                            <option value="annee" {{ old('unite_duree') == 'annee' ? 'selected' : '' }}>Année(s)</option>
                        </select>
                    </div>
                    @error('duree')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
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
@endsection

