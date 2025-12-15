@extends('layouts.app')

@section('title', (isset($dirigeant) ? 'Modifier' : 'Créer') . ' un dirigeant - Abedrhman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-4">
        <div class="w-full sm:w-auto">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900 dark:text-white">
                {{ isset($dirigeant) ? 'Modifier le dirigeant' : 'Ajouter un dirigeant' }}
            </h2>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">
                Client: <span class="font-medium">{{ $client->nom_raison_sociale }}</span>
            </p>
        </div>
        <a href="{{ route('dirigeants.index', $client->id) }}" class="inline-flex items-center justify-center w-full sm:w-auto px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la liste
        </a>
    </div>

    <!-- Form -->
    <form action="{{ isset($dirigeant) ? route('dirigeants.update', [$client->id, $dirigeant->id]) : route('dirigeants.store', $client->id) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-4 sm:p-6">
        @csrf
        @if(isset($dirigeant))
            @method('PUT')
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
            <!-- Intitulé -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Intitulé</label>
                <select name="intitule" class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Sélectionner</option>
                    <option value="Mr" {{ old('intitule', $dirigeant->intitule ?? '') === 'Mr' ? 'selected' : '' }}>Mr</option>
                    <option value="Mme" {{ old('intitule', $dirigeant->intitule ?? '') === 'Mme' ? 'selected' : '' }}>Mme</option>
                    <option value="Mlle" {{ old('intitule', $dirigeant->intitule ?? '') === 'Mlle' ? 'selected' : '' }}>Mlle</option>
                </select>
            </div>

            <!-- Nom -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom</label>
                <input type="text" name="nom" value="{{ old('nom', $dirigeant->nom ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Prénom -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Prénom</label>
                <input type="text" name="prenom" value="{{ old('prenom', $dirigeant->prenom ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Fonction -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fonction</label>
                <select name="fonction" class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Sélectionner</option>
                    <option value="Gérant" {{ old('fonction', $dirigeant->fonction ?? '') === 'Gérant' ? 'selected' : '' }}>Gérant</option>
                    <option value="Co-gérant" {{ old('fonction', $dirigeant->fonction ?? '') === 'Co-gérant' ? 'selected' : '' }}>Co-gérant</option>
                    <option value="Président" {{ old('fonction', $dirigeant->fonction ?? '') === 'Président' ? 'selected' : '' }}>Président</option>
                    <option value="Trésorier" {{ old('fonction', $dirigeant->fonction ?? '') === 'Trésorier' ? 'selected' : '' }}>Trésorier</option>
                    <option value="Secrétaire" {{ old('fonction', $dirigeant->fonction ?? '') === 'Secrétaire' ? 'selected' : '' }}>Secrétaire</option>
                    <option value="Actionnaire" {{ old('fonction', $dirigeant->fonction ?? '') === 'Actionnaire' ? 'selected' : '' }}>Actionnaire</option>
                    <option value="Autre" {{ old('fonction', $dirigeant->fonction ?? '') === 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <!-- Type pièce ID -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type pièce ID</label>
                <select name="type_piece_id" id="type_piece_id_select" onchange="toggleNPieceIdField()" class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Sélectionner</option>
                    <option value="CIN" {{ old('type_piece_id', $dirigeant->type_piece_id ?? '') === 'CIN' ? 'selected' : '' }}>CIN</option>
                    <option value="PASSPORT" {{ old('type_piece_id', $dirigeant->type_piece_id ?? '') === 'PASSPORT' ? 'selected' : '' }}>PASSPORT</option>
                    <option value="CARTE SEJOUR" {{ old('type_piece_id', $dirigeant->type_piece_id ?? '') === 'CARTE SEJOUR' ? 'selected' : '' }}>CARTE SEJOUR</option>
                    <option value="CARTE ETRANGERE" {{ old('type_piece_id', $dirigeant->type_piece_id ?? '') === 'CARTE ETRANGERE' ? 'selected' : '' }}>CARTE ETRANGERE</option>
                </select>
            </div>

            <!-- N° pièce ID -->
            <div id="n_piece_id_field" style="display: {{ old('type_piece_id', $dirigeant->type_piece_id ?? '') ? 'block' : 'none' }};">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">N° pièce ID</label>
                <input type="text" name="n_piece_id" value="{{ old('n_piece_id', $dirigeant->n_piece_id ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Pièce ID -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pièce ID</label>
                <input type="text" name="piece_id" value="{{ old('piece_id', $dirigeant->piece_id ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Date de naissance -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date de naissance</label>
                <input type="date" name="date_naissance" value="{{ old('date_naissance', isset($dirigeant->date_naissance) ? $dirigeant->date_naissance->format('Y-m-d') : '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Lieu de naissance -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lieu de naissance</label>
                <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $dirigeant->lieu_naissance ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Nationalité -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nationalité</label>
                <select name="nationalite" class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">Sélectionner</option>
                    <option value="Marocain résidant" {{ old('nationalite', $dirigeant->nationalite ?? '') === 'Marocain résidant' ? 'selected' : '' }}>Marocain résidant</option>
                    <option value="Marocain non résidant" {{ old('nationalite', $dirigeant->nationalite ?? '') === 'Marocain non résidant' ? 'selected' : '' }}>Marocain non résidant</option>
                    <option value="Étranger résidant" {{ old('nationalite', $dirigeant->nationalite ?? '') === 'Étranger résidant' ? 'selected' : '' }}>Étranger résidant</option>
                    <option value="Étranger non résidant" {{ old('nationalite', $dirigeant->nationalite ?? '') === 'Étranger non résidant' ? 'selected' : '' }}>Étranger non résidant</option>
                </select>
            </div>

            <!-- Adresse -->
            <div class="md:col-span-2">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adresse</label>
                <textarea name="adresse" rows="2" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">{{ old('adresse', $dirigeant->adresse ?? '') }}</textarea>
            </div>

            <!-- Ville -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ville</label>
                <input type="text" name="ville" value="{{ old('ville', $dirigeant->ville ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Pays -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pays</label>
                <input type="text" name="pays" value="{{ old('pays', $dirigeant->pays ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Tél1 résp -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél1 résp</label>
                <input type="tel" name="tel1_resp" value="{{ old('tel1_resp', $dirigeant->tel1_resp ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Tél2 résp -->
            <div>
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél2 résp</label>
                <input type="tel" name="tel2_resp" value="{{ old('tel2_resp', $dirigeant->tel2_resp ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>

            <!-- Email résp -->
            <div class="md:col-span-2">
                <label class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email résp</label>
                <input type="email" name="email_resp" value="{{ old('email_resp', $dirigeant->email_resp ?? '') }}" 
                    class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 sm:gap-4">
            <a href="{{ route('actionnaires.index', $client->id) }}" class="px-4 sm:px-6 py-2 text-sm sm:text-base text-center border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors order-2 sm:order-1">
                Annuler
            </a>
            <button type="submit" class="px-4 sm:px-6 py-2 text-sm sm:text-base bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors order-1 sm:order-2">
                {{ isset($dirigeant) ? 'Modifier' : 'Ajouter' }} le dirigeant
            </button>
        </div>
    </form>
</div>

<script>
function toggleNPieceIdField() {
    const typePieceSelect = document.getElementById('type_piece_id_select');
    const nPieceIdField = document.getElementById('n_piece_id_field');
    
    if (!typePieceSelect || !nPieceIdField) {
        return;
    }
    
    const selectedValue = typePieceSelect.value;
    
    if (selectedValue && selectedValue !== '') {
        nPieceIdField.style.display = 'block';
    } else {
        nPieceIdField.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    toggleNPieceIdField();
});
</script>
@endsection

