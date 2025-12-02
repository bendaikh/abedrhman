@extends('layouts.app')

@section('title', 'Facture ' . $facture->numero . ' - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm flex-wrap">
        <a href="{{ route('factures.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-violet-600 dark:hover:text-violet-400 transition-colors">Factures</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">{{ $facture->numero }}</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-violet-600 to-purple-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Facture {{ $facture->numero }}</h2>
                <p class="text-violet-100 text-sm sm:text-base">
                    Créée le {{ $facture->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('factures.print', $facture) }}" target="_blank"
                    class="inline-flex items-center justify-center px-4 py-2 bg-white text-violet-700 font-medium rounded-lg hover:bg-violet-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Imprimer
                </a>
                <a href="{{ route('factures.index') }}" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
            </div>
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
        <!-- Facture Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Client Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informations Client
                </h3>
                @if($facture->client)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Nom / Raison sociale</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">
                            {{ $facture->client->type === 'morale' ? $facture->client->nom_raison_sociale : ($facture->client->nom . ' ' . $facture->client->prenom) }}
                        </p>
                    </div>
                    @if($facture->client->type === 'morale' && $facture->client->dirigeants->count() > 0)
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Gérant</p>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white mt-1">{{ $facture->client->dirigeants->first()->nom ?? 'N/A' }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Adresse</p>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $facture->client->siege_social ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Ville</p>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $facture->client->ville ?? 'N/A' }}</p>
                    </div>
                    @if($facture->client->ice)
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">ICE</p>
                        <p class="text-sm text-gray-900 dark:text-white mt-1">{{ $facture->client->ice }}</p>
                    </div>
                    @endif
                </div>
                @else
                <p class="text-sm text-gray-500 dark:text-gray-400">Client non spécifié</p>
                @endif
            </div>

            <!-- Service Details -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Détails du Service
                </h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th class="text-left py-2 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Description</th>
                                <th class="text-right py-2 text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-3">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $facture->service->typeService->nom ?? 'Service' }}</p>
                                    @if($facture->service->description)
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $facture->service->description }}</p>
                                    @endif
                                </td>
                                <td class="py-3 text-right">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $facture->formatted_montant_total }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary & Actions -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Status Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Statut</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $facture->statut_color }}">
                    {{ $facture->statut_label }}
                </span>
                
                <form action="{{ route('factures.update-statut', $facture) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Changer le statut</label>
                    <select name="statut" onchange="this.form.submit()"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                        <option value="brouillon" {{ $facture->statut == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                        <option value="envoyee" {{ $facture->statut == 'envoyee' ? 'selected' : '' }}>Envoyée</option>
                        <option value="payee" {{ $facture->statut == 'payee' ? 'selected' : '' }}>Payée</option>
                        <option value="partielle" {{ $facture->statut == 'partielle' ? 'selected' : '' }}>Partiellement payée</option>
                        <option value="annulee" {{ $facture->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </form>
            </div>

            <!-- Amount Summary -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Récapitulatif</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Montant Total</span>
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $facture->formatted_montant_total }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Montant Payé</span>
                        <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ $facture->formatted_montant_paye }}</span>
                    </div>
                    <hr class="border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Reste à Payer</span>
                        <span class="text-sm font-bold {{ $facture->montant_restant > 0 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }}">
                            {{ $facture->formatted_montant_restant }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Dates -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Dates</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Date de facturation</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $facture->date_facture->format('d/m/Y') }}</p>
                    </div>
                    @if($facture->date_echeance)
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Date d'échéance</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">{{ $facture->date_echeance->format('d/m/Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

