@extends('layouts.app')

@section('title', 'Offre de services - Abedrhman')
@section('page-title', 'Offre de services')

@section('content')
@php
    $tiers = ['Fournisseurs', 'Partenaires', 'Personnel', 'Comptable bailleur', 'Administration'];
    $services = ['Création domiciliation', 'Étude', 'Formation', 'Événement', 'Location bureau', 'Location', 'Salle'];
    $unitPricing = ['Standard', 'Promotionnelle', 'Préférentielle'];
    $packPricing = ['Pack 1', 'Pack 2', 'Pack 3'];
    $creationSteps = [
        'Qualification du besoin',
        'Étude & cadrage',
        'Conception et contractualisation',
        'Déploiement et accompagnement'
    ];
    $domiciliationSteps = [
        ['index' => 1, 'title' => 'Demande', 'text' => 'Collecte de la demande et des pièces annexes'],
        ['index' => 2, 'title' => 'Signature contrat', 'text' => 'Validation des clauses et paraphe du contrat'],
        ['index' => 3, 'title' => 'Signat', 'text' => 'Apposition des signatures complémentaires (clients / partenaires)'],
        ['index' => 4, 'title' => 'Validation', 'text' => 'Contrôle final et mise à disposition du service']
    ];
@endphp
<div class="space-y-8">
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div id="section-tableau-de-bord" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Tableau de bord</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                Vue globale simplifiée pour suivre d’un coup d’œil les indicateurs clés de
                l’activité et lancer rapidement les principales actions.
            </p>
        </div>
        <div id="section-base-clientele" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Base clientèle</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Centralisation des profils clients, coordonnées, pièces contractuelles et
                historiques d’interaction pour nourrir les services proposés.
            </p>
        </div>
        <div id="section-base-tiers" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Base tiers</h2>
            <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                @foreach ($tiers as $tier)
                    <li class="flex items-center">
                        <span class="h-2 w-2 rounded-full bg-blue-500 mr-3"></span>
                        {{ $tier }}
                    </li>
                @endforeach
            </ul>
            <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                Fournisseurs, partenaires, personnel, comptable bailleur et administrations sont suivis au même endroit.
            </p>
        </div>
    </section>

    <section id="section-services" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
        <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Services</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">Catalogue d’offres activables individuellement ou en pack</p>
        </div>
        <div class="flex flex-wrap gap-3">
            @foreach ($services as $service)
                <span class="px-4 py-2 rounded-full text-sm font-medium bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-200">
                    {{ $service }}
                </span>
            @endforeach
        </div>
    </section>

    <section id="section-tarification" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tarification unitaire</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Facturation par service selon le niveau d’accompagnement recherché.
            </p>
            <ul class="space-y-3">
                @foreach ($unitPricing as $price)
                    <li class="flex items-start">
                        <span class="mt-1 h-2 w-2 rounded-full bg-emerald-500 mr-3"></span>
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $price }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Conditions adaptées à la situation client.</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tarification pack</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Combinaisons de services prêtes à l’emploi pour accélérer l’onboarding.
            </p>
            <ul class="space-y-3">
                @foreach ($packPricing as $pack)
                    <li class="flex items-start">
                        <span class="mt-1 h-2 w-2 rounded-full bg-purple-500 mr-3"></span>
                        <div>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $pack }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Inclusions et remises définies selon le pack.</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div id="section-etapes-creation" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Étapes service création</h3>
            <ol class="space-y-4">
                @foreach ($creationSteps as $index => $step)
                    <li class="flex items-start">
                        <span class="flex-shrink-0 h-8 w-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-semibold mr-4">
                            {{ $index + 1 }}
                        </span>
                        <p class="text-sm text-gray-700 dark:text-gray-200">{{ $step }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
        <div id="section-etapes-domiciliation" class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Étapes service domiciliation</h3>
            <ol class="space-y-4">
                @foreach ($domiciliationSteps as $step)
                    <li class="flex items-start">
                        <span class="flex-shrink-0 h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold mr-4">
                            {{ $step['index'] }}
                        </span>
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $step['title'] }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $step['text'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>
</div>
@endsection


