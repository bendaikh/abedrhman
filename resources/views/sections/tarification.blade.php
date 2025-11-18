@extends('layouts.app')

@section('title', 'Tarification - Abedrhman')

@section('content')
@php
    $unitPricing = ['Standard', 'Promotionnelle', 'Préférentielle'];
    $packPricing = ['Pack 1', 'Pack 2', 'Pack 3'];
@endphp
<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6 border border-gray-100 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tarification unitaire</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                Facturation par service selon le niveau d'accompagnement recherché.
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
                Combinaisons de services prêtes à l'emploi pour accélérer l'onboarding.
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
    </div>
</div>
@endsection

