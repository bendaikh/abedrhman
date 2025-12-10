@extends('layouts.app')

@section('title', 'Gestion des Paiements - Abedrhman')

@section('content')
<div class="space-y-6 sm:space-y-8">
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-700 rounded-xl sm:rounded-2xl p-6 sm:p-8 text-white">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold mb-2 flex items-center gap-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Gestion des Paiements
                </h2>
                <p class="text-emerald-100 text-sm sm:text-base">
                    Gérez et suivez tous les paiements de vos services
                </p>
            </div>
            <button type="button" onclick="openPaymentModal()" 
                class="inline-flex items-center justify-center px-4 py-2 bg-white text-emerald-700 font-semibold rounded-lg hover:bg-emerald-50 transition-colors shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ajouter paiement
            </button>
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

    <!-- Encaissé / Non Encaissé Blocks -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Encaissé Block -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-emerald-200 dark:border-emerald-800 p-5">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                    <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Encaissé</p>
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300">
                            {{ $encaisseCount }} paiement(s)
                        </span>
                    </div>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ number_format($encaisseAmount, 2, ',', ' ') }} DH</p>
                </div>
            </div>
        </div>

        <!-- Non Encaissé Block -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-amber-200 dark:border-amber-800 p-5">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                    <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase">Non Encaissé</p>
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300">
                            {{ $nonEncaisseCount }} paiement(s)
                        </span>
                    </div>
                    <p class="text-2xl font-bold text-amber-600 dark:text-amber-400 mt-1">{{ number_format($nonEncaisseAmount, 2, ',', ' ') }} DH</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Payments -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Total Paiements</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $payments->total() }}</p>
                </div>
            </div>
        </div>

        <!-- Total Amount -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Montant Total</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($totalAmount, 2, ',', ' ') }} DH</p>
                </div>
            </div>
        </div>

        <!-- Today's Payments -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Aujourd'hui</p>
                    <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($todayAmount, 2, ',', ' ') }} DH</p>
                </div>
            </div>
        </div>

        <!-- This Month -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Ce Mois</p>
                    <p class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ number_format($monthAmount, 2, ',', ' ') }} DH</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-100 dark:border-gray-700 p-4 sm:p-6">
        <form method="GET" action="{{ route('payments.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rechercher</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                    placeholder="Client, référence...">
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type</label>
                <select name="type" id="type"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    <option value="">Tous</option>
                    <option value="avance" {{ request('type') == 'avance' ? 'selected' : '' }}>Avance</option>
                    <option value="paiement" {{ request('type') == 'paiement' ? 'selected' : '' }}>Paiement</option>
                    <option value="solde" {{ request('type') == 'solde' ? 'selected' : '' }}>Solde</option>
                </select>
            </div>

            <!-- Payment Mode Filter -->
            <div>
                <label for="mode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mode</label>
                <select name="mode" id="mode"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    <option value="">Tous</option>
                    <option value="especes" {{ request('mode') == 'especes' ? 'selected' : '' }}>Espèces</option>
                    <option value="cheque" {{ request('mode') == 'cheque' ? 'selected' : '' }}>Chèque</option>
                    <option value="virement" {{ request('mode') == 'virement' ? 'selected' : '' }}>Virement</option>
                    <option value="carte" {{ request('mode') == 'carte' ? 'selected' : '' }}>Carte bancaire</option>
                    <option value="lcn" {{ request('mode') == 'lcn' ? 'selected' : '' }}>LCN (traite)</option>
                </select>
            </div>

            <!-- Date Range -->
            <div>
                <label for="date_from" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date début</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
            </div>

            <div class="flex items-end gap-2">
                <div class="flex-1">
                    <label for="date_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date fin</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                @if(request()->hasAny(['search', 'type', 'mode', 'date_from', 'date_to']))
                <a href="{{ route('payments.index') }}"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Payments Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl sm:rounded-2xl shadow border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="h-10 w-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Liste des Paiements</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $payments->total() }} paiement(s) au total</p>
                    </div>
                </div>
            </div>
        </div>

        @if($payments->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900/50">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Client</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Mode</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">N°Trans.</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Émission</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Échéance</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Encaissé</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">N°Reçu</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Montant</th>
                        <th class="px-3 py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($payments as $payment)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors {{ !$payment->encaisse ? 'bg-amber-50/50 dark:bg-amber-900/10' : '' }}">
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $payment->date_paiement->format('d/m/Y') }}
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap">
                            @if($payment->service && $payment->service->client)
                            <div class="flex items-center">
                                <div class="h-8 w-8 rounded-full bg-teal-100 dark:bg-teal-900/30 flex items-center justify-center mr-2">
                                    <span class="text-xs font-medium text-teal-700 dark:text-teal-300">
                                        {{ substr($payment->service->client->type === 'morale' ? $payment->service->client->nom_raison_sociale : $payment->service->client->nom, 0, 2) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate max-w-[150px]">
                                        {{ $payment->service->client->type === 'morale' ? $payment->service->client->nom_raison_sociale : ($payment->service->client->nom . ' ' . $payment->service->client->prenom) }}
                                    </p>
                                </div>
                                <a href="{{ route('services.payments', $payment->service_id) }}" 
                                    class="ml-2 p-1.5 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors" 
                                    title="Voir les paiements du service">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                            @else
                            <span class="text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $payment->mode_paiement_label }}
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $payment->numero_transaction ?? '-' }}
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $payment->date_emission ? $payment->date_emission->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $payment->date_echeance ? $payment->date_echeance->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap">
                            @if($payment->encaisse)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                                Oui
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300">
                                Non
                            </span>
                            @endif
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300">
                            {{ $payment->numero_recu ?? '-' }}
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap">
                            <span class="text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ $payment->formatted_montant }}</span>
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-1">
                                @if(!$payment->encaisse)
                                <!-- Toggle Encaisse Button -->
                                <form action="{{ route('payments.toggle-encaisse', $payment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" 
                                        class="p-2 text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded-lg transition-colors" 
                                        title="Marquer comme encaissé">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('services.payments', $payment->service_id) }}" 
                                    class="p-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors" 
                                    title="Voir le service">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <form action="{{ route('services.payments.destroy', [$payment->service_id, $payment]) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @if($payment->commentaire)
                    <tr class="bg-gray-50/50 dark:bg-gray-900/20">
                        <td colspan="10" class="px-3 py-2 text-xs text-gray-500 dark:text-gray-400 italic">
                            <span class="font-medium">Commentaire:</span> {{ $payment->commentaire }}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($payments->hasPages())
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
            {{ $payments->links() }}
        </div>
        @endif
        @else
        <div class="p-8 text-center">
            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucun paiement</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                @if(request()->hasAny(['search', 'type', 'mode', 'date_from', 'date_to']))
                Aucun paiement ne correspond à vos critères de recherche.
                @else
                Aucun paiement n'a été enregistré pour le moment.
                @endif
            </p>
        </div>
        @endif
    </div>
</div>

<!-- Payment Modal -->
<div id="payment-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50" onclick="closePaymentModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ajouter un paiement</h3>
                    <button type="button" onclick="closePaymentModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <form action="{{ route('payments.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                
                <!-- Client Selection -->
                <div>
                    <label for="modal_client_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Client *</label>
                    <select id="modal_client_id" onchange="updateServicesDropdown()" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" data-services="{{ json_encode($client->services) }}">
                            {{ $client->type === 'morale' ? $client->nom_raison_sociale : ($client->nom . ' ' . $client->prenom) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Service Selection -->
                <div>
                    <label for="modal_service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Service *</label>
                    <select name="service_id" id="modal_service_id" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        <option value="">Sélectionner d'abord un client</option>
                    </select>
                </div>

                <!-- Montant -->
                <div>
                    <label for="modal_montant" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Montant (DH) *</label>
                    <input type="number" name="montant" id="modal_montant" required min="0.01" step="0.01"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                        placeholder="0.00">
                </div>

                <!-- Mode de paiement -->
                <div>
                    <label for="modal_mode_paiement" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mode de paiement *</label>
                    <select name="mode_paiement" id="modal_mode_paiement" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        <option value="especes">Espèces</option>
                        <option value="cheque">Chèque</option>
                        <option value="virement">Virement</option>
                        <option value="carte">Carte bancaire</option>
                        <option value="lcn">LCN (traite)</option>
                    </select>
                </div>

                <!-- Date de paiement -->
                <div>
                    <label for="modal_date_paiement" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date de paiement *</label>
                    <input type="date" name="date_paiement" id="modal_date_paiement" value="{{ date('Y-m-d') }}" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                </div>

                <!-- Encaissé -->
                <div class="flex items-center">
                    <input type="checkbox" name="encaisse" id="modal_encaisse" value="1" checked
                        class="w-4 h-4 text-emerald-600 bg-white dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-emerald-500 focus:ring-2">
                    <label for="modal_encaisse" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Encaissé</label>
                </div>

                <!-- Commentaire -->
                <div>
                    <label for="modal_commentaire" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Commentaire</label>
                    <textarea name="commentaire" id="modal_commentaire" rows="2"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors resize-none"
                        placeholder="Commentaire..."></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="closePaymentModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openPaymentModal() {
    document.getElementById('payment-modal').classList.remove('hidden');
}

function closePaymentModal() {
    document.getElementById('payment-modal').classList.add('hidden');
}

function updateServicesDropdown() {
    const clientSelect = document.getElementById('modal_client_id');
    const serviceSelect = document.getElementById('modal_service_id');
    const selectedOption = clientSelect.options[clientSelect.selectedIndex];
    
    // Clear services
    serviceSelect.innerHTML = '<option value="">Sélectionner un service</option>';
    
    if (selectedOption && selectedOption.dataset.services) {
        const services = JSON.parse(selectedOption.dataset.services);
        services.forEach(service => {
            const option = document.createElement('option');
            option.value = service.id;
            option.textContent = (service.type_service ? service.type_service.nom : 'Service') + ' - ' + 
                new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'MAD' }).format(service.prix).replace('MAD', 'DH');
            serviceSelect.appendChild(option);
        });
    }
}
</script>
@endsection
