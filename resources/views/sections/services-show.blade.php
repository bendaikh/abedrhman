@extends('layouts.app')

@section('title', 'Détails du service - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm">
        <a href="{{ route('services.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-teal-600 dark:hover:text-teal-400 transition-colors">Services</a>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-900 dark:text-white font-medium">Détails du service</span>
    </div>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-teal-600 to-cyan-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2">Détails du Service</h2>
                <p class="text-teal-100 text-sm sm:text-base">
                    {{ $service->typeService->nom ?? 'N/A' }} - 
                    {{ $service->client ? ($service->client->type === 'morale' ? $service->client->nom_raison_sociale : ($service->client->nom . ' ' . $service->client->prenom)) : 'N/A' }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('services.edit', $service) }}" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-white text-teal-700 font-medium rounded-lg hover:bg-teal-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Modifier
                </a>
                <a href="{{ route('services.payments', $service) }}" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Paiements
                </a>
            </div>
        </div>
    </div>

    <!-- Service Info Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Type de Service -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Type de Service</p>
                    <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $service->typeService->nom ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Prix de base -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Prix de base</p>
                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $service->formatted_prix }}</p>
                </div>
            </div>
        </div>

        <!-- Montant Total -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Montant Total</p>
                    <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $service->formatted_montant_total }}</p>
                </div>
            </div>
        </div>

        <!-- Statut -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl {{ $service->status === 'termine' ? 'bg-emerald-100 dark:bg-emerald-900/30' : ($service->status === 'annule' ? 'bg-red-100 dark:bg-red-900/30' : 'bg-amber-100 dark:bg-amber-900/30') }} flex items-center justify-center">
                    <svg class="w-6 h-6 {{ $service->status === 'termine' ? 'text-emerald-600 dark:text-emerald-400' : ($service->status === 'annule' ? 'text-red-600 dark:text-red-400' : 'text-amber-600 dark:text-amber-400') }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Statut</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium {{ $service->status_color }}">
                        {{ $service->status_label }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Progress -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            Progression des paiements
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Payé</p>
                <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $service->formatted_total_payments }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Reste à payer</p>
                <p class="text-2xl font-bold {{ $service->remaining_amount > 0 ? 'text-amber-600 dark:text-amber-400' : 'text-emerald-600 dark:text-emerald-400' }}">{{ $service->formatted_remaining_amount }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Progression</p>
                <div class="flex items-center gap-3">
                    <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                        <div class="h-3 rounded-full transition-all duration-300 {{ $service->is_fully_paid ? 'bg-emerald-500' : 'bg-amber-500' }}" 
                             style="width: {{ $service->payment_progress }}%"></div>
                    </div>
                    <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $service->payment_progress }}%</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Client Info -->
        @if($service->client)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Informations du client
            </h3>
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-full bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center">
                        <span class="text-lg font-bold text-teal-600 dark:text-teal-400">
                            {{ strtoupper(substr($service->client->type === 'morale' ? $service->client->nom_raison_sociale : $service->client->nom, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $service->client->type === 'morale' ? $service->client->nom_raison_sociale : ($service->client->nom . ' ' . $service->client->prenom) }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $service->client->type === 'morale' ? 'Personne Morale' : 'Particulier' }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Ville</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->client->ville ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Téléphone</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->client->tel_1 ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">Email</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->client->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">N° Client</p>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->client->num_client ?? 'N/A' }}</p>
                    </div>
                </div>
                <a href="{{ route('clients.show', $service->client) }}" class="inline-flex items-center text-sm text-teal-600 hover:text-teal-700 dark:text-teal-400 dark:hover:text-teal-300">
                    Voir la fiche client
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
        @endif

        <!-- Sous-services -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Sous-services
                </h3>
                <a href="{{ route('services.sous-services', $service) }}" class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                    Gérer
                </a>
            </div>
            @if($service->sousServices->count() > 0)
            <div class="space-y-2">
                @foreach($service->sousServices as $sousService)
                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-900/50 rounded-lg">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $sousService->nom }}</span>
                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ $sousService->formatted_prix }}</span>
                </div>
                @endforeach
                <div class="flex items-center justify-between p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-200 dark:border-indigo-800">
                    <span class="text-sm font-semibold text-indigo-800 dark:text-indigo-200">Total sous-services</span>
                    <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($service->total_sous_services, 2, ',', ' ') }} DH</span>
                </div>
            </div>
            @else
            <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">Aucun sous-service attaché</p>
            @endif
        </div>
    </div>

    <!-- Description -->
    @if($service->description)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Description
        </h3>
        <p class="text-gray-600 dark:text-gray-300">{{ $service->description }}</p>
    </div>
    @endif

    <!-- Recent Payments -->
    @if($service->payments->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Historique des paiements
                </h3>
                <a href="{{ route('services.payments', $service) }}" class="text-sm text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300">
                    Voir tous
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Mode</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">N° Reçu</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Encaissé</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase">Montant</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($service->payments->sortByDesc('date_paiement')->take(5) as $payment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">{{ $payment->date_paiement->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $payment->mode_paiement_label }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $payment->numero_recu ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($payment->encaisse)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">Oui</span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300">Non</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-emerald-600 dark:text-emerald-400 text-right">{{ $payment->formatted_montant }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Actions -->
    <div class="flex items-center justify-between pt-4">
        <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la liste
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('services.invoice', $service) }}" target="_blank" 
                class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Reçu
            </a>
            <a href="{{ route('services.payments', $service) }}" 
                class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Gérer les paiements
            </a>
        </div>
    </div>
</div>
@endsection

