@extends('layouts.app')

@section('title', ($client ? 'Modifier' : 'Créer') . ' un client - Abedrhman')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">
                {{ $client ? 'Modifier le client' : 'Créer un client' }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ $client ? 'Modifiez les informations du client' : 'Remplissez les informations pour créer un nouveau client' }}
            </p>
        </div>
        <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-colors">
            Retour à la liste
        </a>
    </div>

    <!-- Form -->
    <form action="{{ $client ? route('clients.update', $client->id) : route('clients.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-100 dark:border-gray-700 p-6">
        @csrf
        @if($client)
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Num client -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <span class="text-orange-600 dark:text-orange-400 font-semibold">Num client</span>
                </label>
                <input type="text" name="num_client" value="{{ old('num_client', $client->num_client ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Généré automatiquement si vide">
            </div>

            <!-- Type -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type *</label>
                <select name="type" id="client_type" onchange="toggleClientTypeFields()" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="particulier" {{ old('type', $client->type ?? 'societe') === 'particulier' ? 'selected' : '' }}>Particulier</option>
                    <option value="societe" {{ old('type', $client->type ?? 'societe') === 'societe' ? 'selected' : '' }}>Entreprise</option>
                </select>
            </div>

            <!-- Particulier Fields -->
            <div id="particulier_fields" class="md:col-span-2" style="display: {{ (old('type', $client->type ?? 'societe') === 'particulier') ? 'block' : 'none' }};">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $client->nom ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Prénom -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Prénom</label>
                        <input type="text" name="prenom" value="{{ old('prenom', $client->prenom ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Fonction -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fonction</label>
                        <input type="text" name="fonction" value="{{ old('fonction', $client->fonction ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Type pièce ID -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type pièce ID</label>
                        <select name="type_piece_id" id="type_piece_id_select" onchange="toggleNPieceIdField()" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Sélectionner</option>
                            <option value="CIN" {{ old('type_piece_id', $client->type_piece_id ?? '') === 'CIN' ? 'selected' : '' }}>CIN</option>
                            <option value="PASSPORT" {{ old('type_piece_id', $client->type_piece_id ?? '') === 'PASSPORT' ? 'selected' : '' }}>PASSPORT</option>
                            <option value="CARTE SEJOUR" {{ old('type_piece_id', $client->type_piece_id ?? '') === 'CARTE SEJOUR' ? 'selected' : '' }}>CARTE SEJOUR</option>
                            <option value="CARTE ETRANGERE" {{ old('type_piece_id', $client->type_piece_id ?? '') === 'CARTE ETRANGERE' ? 'selected' : '' }}>CARTE ETRANGERE</option>
                        </select>
                    </div>

                    <!-- N° pièce ID -->
                    <div id="n_piece_id_field" style="display: {{ old('type_piece_id', $client->type_piece_id ?? '') ? 'block' : 'none' }};">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">N° pièce ID</label>
                        <input type="text" name="n_piece_id" value="{{ old('n_piece_id', $client->n_piece_id ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Date naissance -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date naissance</label>
                        <input type="date" name="date_naissance" value="{{ old('date_naissance', ($client && $client->date_naissance) ? $client->date_naissance->format('Y-m-d') : '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Lieu naissance -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lieu naissance</label>
                        <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $client->lieu_naissance ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Nationalité -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nationalité</label>
                        <select name="nationalite" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Sélectionner</option>
                            <option value="Marocain résident" {{ old('nationalite', $client->nationalite ?? '') === 'Marocain résident' ? 'selected' : '' }}>Marocain résident</option>
                            <option value="Marocain non résident" {{ old('nationalite', $client->nationalite ?? '') === 'Marocain non résident' ? 'selected' : '' }}>Marocain non résident</option>
                            <option value="Étranger résident" {{ old('nationalite', $client->nationalite ?? '') === 'Étranger résident' ? 'selected' : '' }}>Étranger résident</option>
                            <option value="Étranger non résident" {{ old('nationalite', $client->nationalite ?? '') === 'Étranger non résident' ? 'selected' : '' }}>Étranger non résident</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Société Fields -->
            <div id="societe_fields" class="md:col-span-2" style="display: {{ (old('type', $client->type ?? 'societe') === 'societe') ? 'block' : 'none' }};">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom / raison sociale -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom / raison sociale</label>
                        <input type="text" name="nom_raison_sociale" value="{{ old('nom_raison_sociale', $client->nom_raison_sociale ?? '') }}" 
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                        <!-- Sigle -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sigle</label>
                            <input type="text" name="sigle" value="{{ old('sigle', $client->sigle ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Intitulé -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Intitulé</label>
                            <select name="intitule" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner</option>
                                <option value="Société" {{ old('intitule', $client->intitule ?? '') === 'Société' ? 'selected' : '' }}>Société</option>
                                <option value="Entreprise individuelle" {{ old('intitule', $client->intitule ?? '') === 'Entreprise individuelle' ? 'selected' : '' }}>Entreprise individuelle</option>
                                <option value="Coopérative" {{ old('intitule', $client->intitule ?? '') === 'Coopérative' ? 'selected' : '' }}>Coopérative</option>
                                <option value="Association" {{ old('intitule', $client->intitule ?? '') === 'Association' ? 'selected' : '' }}>Association</option>
                            </select>
                        </div>

                        <!-- Forme juridique -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Forme juridique</label>
                            <select name="forme_juridique" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner</option>
                                <option value="Sarl" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'Sarl' ? 'selected' : '' }}>Sarl</option>
                                <option value="Sarl Au" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'Sarl Au' ? 'selected' : '' }}>Sarl Au</option>
                                <option value="Personne physique" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'Personne physique' ? 'selected' : '' }}>Personne physique</option>
                                <option value="Coopérative" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'Coopérative' ? 'selected' : '' }}>Coopérative</option>
                                <option value="Association" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'Association' ? 'selected' : '' }}>Association</option>
                                <option value="Auto-Entrepreneur" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'Auto-Entrepreneur' ? 'selected' : '' }}>Auto-Entrepreneur</option>
                                <option value="SA" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'SA' ? 'selected' : '' }}>SA</option>
                                <option value="Autre" {{ old('forme_juridique', $client->forme_juridique ?? '') === 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                        </div>

                        <!-- Pièce justificative -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pièce justificative</label>
                            <select name="piece_justificative" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner</option>
                                <option value="RC PM" {{ old('piece_justificative', $client->piece_justificative ?? '') === 'RC PM' ? 'selected' : '' }}>RC PM</option>
                                <option value="RC PP" {{ old('piece_justificative', $client->piece_justificative ?? '') === 'RC PP' ? 'selected' : '' }}>RC PP</option>
                                <option value="Attestation Odeco" {{ old('piece_justificative', $client->piece_justificative ?? '') === 'Attestation Odeco' ? 'selected' : '' }}>Attestation Odeco</option>
                                <option value="Recus de dépôt ass" {{ old('piece_justificative', $client->piece_justificative ?? '') === 'Recus de dépôt ass' ? 'selected' : '' }}>Recus de dépôt ass</option>
                                <option value="Carte ou Attest AE" {{ old('piece_justificative', $client->piece_justificative ?? '') === 'Carte ou Attest AE' ? 'selected' : '' }}>Carte ou Attest AE</option>
                            </select>
                        </div>

                        <!-- N° pièce -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">N° pièce</label>
                            <input type="text" name="numero_piece" value="{{ old('numero_piece', $client->numero_piece ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Date création -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date création</label>
                            <input type="date" name="date_creation" value="{{ old('date_creation', ($client && $client->date_creation) ? $client->date_creation->format('Y-m-d') : '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Forme juridique créée -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Forme juridique créée</label>
                            <select name="forme_juridique_creee" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner</option>
                                <option value="Oui" {{ old('forme_juridique_creee', $client->forme_juridique_creee ?? '') === 'Oui' ? 'selected' : '' }}>Oui</option>
                                <option value="Encours" {{ old('forme_juridique_creee', $client->forme_juridique_creee ?? '') === 'Encours' ? 'selected' : '' }}>Encours</option>
                            </select>
                        </div>

                        <!-- Siège social -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Siège social</label>
                            <textarea name="siege_social" rows="3" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('siege_social', $client->siege_social ?? '') }}</textarea>
                        </div>

                        <!-- Ville -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ville</label>
                            <input type="text" name="ville" value="{{ old('ville', $client->ville ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Pays -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pays</label>
                            <input type="text" name="pays" value="{{ old('pays', $client->pays ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Secteur d'activité -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Secteur d'activité</label>
                            <select name="secteur_activite" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Sélectionner</option>
                                <option value="COMMERCE" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'COMMERCE' ? 'selected' : '' }}>COMMERCE</option>
                                <option value="INDUSTRIE" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'INDUSTRIE' ? 'selected' : '' }}>INDUSTRIE</option>
                                <option value="SERVICES" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'SERVICES' ? 'selected' : '' }}>SERVICES</option>
                                <option value="INFORMATIQUE" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'INFORMATIQUE' ? 'selected' : '' }}>INFORMATIQUE</option>
                                <option value="AGRICULTURE" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'AGRICULTURE' ? 'selected' : '' }}>AGRICULTURE</option>
                                <option value="ARTISANAT" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'ARTISANAT' ? 'selected' : '' }}>ARTISANAT</option>
                                <option value="TOURISME" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'TOURISME' ? 'selected' : '' }}>TOURISME</option>
                                <option value="TRAVAUX ET INSTALATION" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'TRAVAUX ET INSTALATION' ? 'selected' : '' }}>TRAVAUX ET INSTALATION</option>
                                <option value="SANTE" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'SANTE' ? 'selected' : '' }}>SANTE</option>
                                <option value="IMPORT ET EXPORT" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'IMPORT ET EXPORT' ? 'selected' : '' }}>IMPORT ET EXPORT</option>
                                <option value="SPORT ET DIVERTISSEMENT" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'SPORT ET DIVERTISSEMENT' ? 'selected' : '' }}>SPORT ET DIVERTISSEMENT</option>
                                <option value="EDUCATION" {{ old('secteur_activite', $client->secteur_activite ?? '') === 'EDUCATION' ? 'selected' : '' }}>EDUCATION</option>
                            </select>
                        </div>

                        <!-- Activité -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Activité</label>
                            <input type="text" name="activite" value="{{ old('activite', $client->activite ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Autre adresse d'activité -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Autre adresse d'activité</label>
                            <textarea name="autre_adresse_activite" rows="3" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('autre_adresse_activite', $client->autre_adresse_activite ?? '') }}</textarea>
                        </div>

                        <!-- Adresse (dépôt ou magasin) -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Adresse (dépôt ou magasin)</label>
                            <textarea name="adresse_depot_magasin" rows="3" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('adresse_depot_magasin', $client->adresse_depot_magasin ?? '') }}</textarea>
                        </div>

                        <!-- Tél 1 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél 1</label>
                            <input type="text" name="tel_1" value="{{ old('tel_1', $client->tel_1 ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Tél 2 -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tél 2</label>
                            <input type="text" name="tel_2" value="{{ old('tel_2', $client->tel_2 ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Fixe -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Fixe</label>
                            <input type="text" name="fixe" value="{{ old('fixe', $client->fixe ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $client->email ?? '') }}" 
                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

            <!-- Common Fields (Visible for both types) -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Observations</label>
                <textarea name="observations" rows="4" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('observations', $client->observations ?? '') }}</textarea>
            </div>

            <!-- Source -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Source</label>
                <select name="source" id="source_select" onchange="updateIntituleSourceOptions()" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Sélectionner</option>
                    <option value="Spontané" {{ old('source', $client->source ?? '') === 'Spontané' ? 'selected' : '' }}>Spontané</option>
                    <option value="Client" {{ old('source', $client->source ?? '') === 'Client' ? 'selected' : '' }}>Client</option>
                    <option value="Comptable" {{ old('source', $client->source ?? '') === 'Comptable' ? 'selected' : '' }}>Comptable</option>
                    <option value="Média" {{ old('source', $client->source ?? '') === 'Média' ? 'selected' : '' }}>Média</option>
                    <option value="Administration" {{ old('source', $client->source ?? '') === 'Administration' ? 'selected' : '' }}>Administration</option>
                    <option value="Autre" {{ old('source', $client->source ?? '') === 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
            </div>

            <!-- Intitulé source -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Intitulé source</label>
                <select name="intitule_source" id="intitule_source_select" onchange="toggleIntituleSourceDataField()" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Sélectionner une source d'abord</option>
                </select>
            </div>

            <!-- Intitulé source data -->
            <div id="intitule_source_data_field" class="md:col-span-2" style="display: {{ old('intitule_source', $client->intitule_source ?? '') ? 'block' : 'none' }};">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    <span id="intitule_source_data_label">Information supplémentaire</span>
                </label>
                <input type="text" name="intitule_source_data" id="intitule_source_data_input" value="{{ old('intitule_source_data', $client->intitule_source_data ?? '') }}" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Entrez les informations">
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-8 flex items-center justify-end space-x-4">
            <a href="{{ route('clients.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Annuler
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                {{ $client ? 'Modifier' : 'Créer' }} le client
            </button>
        </div>
    </form>
</div>

<script>
function toggleClientTypeFields() {
    const typeSelect = document.getElementById('client_type');
    const particulierFields = document.getElementById('particulier_fields');
    const societeFields = document.getElementById('societe_fields');

    if (!typeSelect || !particulierFields || !societeFields) {
        return;
    }

    const selectedType = typeSelect.value;

    if (selectedType === 'particulier') {
        particulierFields.style.display = 'block';
        societeFields.style.display = 'none';
    } else if (selectedType === 'societe') {
        particulierFields.style.display = 'none';
        societeFields.style.display = 'block';
    } else {
        // Default: hide both if unknown type
        particulierFields.style.display = 'none';
        societeFields.style.display = 'none';
    }
}

function updateIntituleSourceOptions() {
    const sourceSelect = document.getElementById('source_select');
    const intituleSourceSelect = document.getElementById('intitule_source_select');
    
    if (!sourceSelect || !intituleSourceSelect) {
        return;
    }

    const selectedSource = sourceSelect.value;
    const currentValue = intituleSourceSelect.getAttribute('data-current-value') || '';
    
    // Clear existing options
    intituleSourceSelect.innerHTML = '';
    
    // Add default option
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Sélectionner';
    intituleSourceSelect.appendChild(defaultOption);
    
    let options = [];
    
    switch(selectedSource) {
        case 'Client':
            options = ['Liste client'];
            break;
        case 'Comptable':
            options = ['Liste comptables'];
            break;
        case 'Média':
            options = ['Facebook', 'Instagram', 'Youtube', 'Tiktok', 'Linkedin', 'Site web centre', 'Autre'];
            break;
        case 'Spontané':
        case 'Administration':
        case 'Autre':
            options = [];
            break;
        default:
            intituleSourceSelect.innerHTML = '<option value="">Sélectionner une source d\'abord</option>';
            return;
    }
    
    // Add options based on selected source
    options.forEach(optionText => {
        const option = document.createElement('option');
        option.value = optionText;
        option.textContent = optionText;
        if (optionText === currentValue) {
            option.selected = true;
        }
        intituleSourceSelect.appendChild(option);
    });
    
    // Update the data field visibility after updating options
    toggleIntituleSourceDataField();
}

function toggleIntituleSourceDataField() {
    const intituleSourceSelect = document.getElementById('intitule_source_select');
    const dataField = document.getElementById('intitule_source_data_field');
    const dataLabel = document.getElementById('intitule_source_data_label');
    
    if (!intituleSourceSelect || !dataField) {
        return;
    }
    
    const selectedValue = intituleSourceSelect.value;
    
    if (selectedValue && selectedValue !== '') {
        dataField.style.display = 'block';
        // Update label based on selected option
        dataLabel.textContent = 'Détails pour ' + selectedValue;
    } else {
        dataField.style.display = 'none';
    }
}

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
    toggleClientTypeFields();
    
    // Store current value for intitule_source
    const intituleSourceSelect = document.getElementById('intitule_source_select');
    if (intituleSourceSelect) {
        const currentValue = '{{ old("intitule_source", $client->intitule_source ?? "") }}';
        intituleSourceSelect.setAttribute('data-current-value', currentValue);
        updateIntituleSourceOptions();
    }
    
    // Toggle N piece Id field on page load
    toggleNPieceIdField();
    
    // Toggle intitule source data field on page load
    toggleIntituleSourceDataField();
});
</script>
@endsection

